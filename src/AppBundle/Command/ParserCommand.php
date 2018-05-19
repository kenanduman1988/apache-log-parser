<?php

namespace AppBundle\Command;

use AppBundle\Service\ApacheLog;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ParserCommand
 * @package AppBundle\Command
 */
class ParserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('parser:run')
            ->setDescription('Parse apache log file save to mysql.')
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
        $access = $apacheLogService->getAccess();
        $access
            ->setIpPatterns()
            ->setFormat()
        ;
        $file = new \SplFileObject($this->getContainer()->getParameter('access_log_path'));
        $file->setFlags(
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );
        $count = 1;
        foreach ($file as $line) {
            $entity = $access->getEntity($line);
            $apacheLogService->preventDdosAccessLog($entity);
            $apacheLogService->persistDoctrineManager($entity);
            if (0 === 100 % $count) {
                // batch insert each 100 entity and clean memory
                $apacheLogService->flushDoctrineManager();
                $apacheLogService->clearDoctrineManager();
            }
            $count++;
        }
        $output->writeln("Found {$count} lines and imported to database");
    }
}