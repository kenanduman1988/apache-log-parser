<?php

namespace AppBundle\Command;

use AppBundle\Service\ApacheLog;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ParserCommand
 * @package AppBundle\Command
 */
class ParserCommand extends ContainerAwareCommand
{
    /** @var string */
    private $accessLogFile = '/var/log/apache2/test_access.log';

    protected function configure()
    {
        $this
            ->setName('parser:run')
            ->setDescription('Parse access.log from apache to mysql.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \LogicException|\Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ApacheLog $apacheLogService */
        $apacheLogService = $this->getContainer()->get('apachelog');

        /** @var ObjectManager $doctrineManager */
        $doctrineManager = $this->getContainer()->get('doctrine')->getManager();

        $lines = file($this->accessLogFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $count=0;
        foreach ($lines as $line) {
            $count++;
            // Get entity from parsed line
            $entity = $apacheLogService->getAccess()->parse($line);
            /**
             * Optional
             * Check duplicates (Might be ddos alarm here)
             */
            $find = $doctrineManager->getRepository('AppBundle:AccessLog')->findBy([
                'time' => $entity->getTime(),
                'host' => $entity->getHost(),
                'user' => $entity->getUser(),
            ]);
            if (10 < \count($find)) {
                // DDOS ALARM
            }
            $doctrineManager->persist($entity);
            if (0 === 100 % $count || $count === \count($lines) -1) {
                $doctrineManager->flush();
            }
        }
        $output->writeln("Found {$count} lines and imported to database");
    }
}