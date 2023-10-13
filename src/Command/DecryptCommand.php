<?php

namespace LinkORB\Shipyard\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use LinkORB\Shipyard\Sops as SopsWrapper;

class DecryptCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sops:decrypt')
            ->setDescription('Decrypt a sops encrypted file.')
            ->addArgument('filepath', InputArgument::REQUIRED, 'Filepath to decrypt');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filepath = $input->getArgument('filepath');

        $output->writeln("<info>Decrypt `$filepath`</info>");
        $sops = new SopsWrapper();
        $data = $sops->decrypt($filepath);
        return Command::SUCCESS;
    }
}
