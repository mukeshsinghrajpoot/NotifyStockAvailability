<?php

namespace Bluethinkinc\NotifyStockAvailability\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Bluethinkinc\NotifyStockAvailability\Helper\Cronemail;
use Magento\Framework\App\State;

class Notifycommnad extends Command
{
    /**
     * This is a state
     *
     * @var state $state
     */
     protected $state;
    /**
     * This is a helpervalue
     *
     * @var helpervalue $helpervalue
     */
     private $helpervalue;
    /**
     * This is a construct
     *
     * @param State     $state
     * @param Cronemail $helpervalue
     */
    public function __construct(
        State $state,
        Cronemail $helpervalue
    ) {
        $this->state = $state;
        $this->helpervalue = $helpervalue;
        parent::__construct();
    }

    /**
     * This is a configure function
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('notify:notifyuser');
        $this->setDescription('notify user when product in stock command line');
        parent::configure();
    }

    /**
     * This is a execute
     *
     * @return execute
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
        $data = $this->helpervalue->syncnotifyuser();
        $output->writeln($data);
        return 0;
    }
}
