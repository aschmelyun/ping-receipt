<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class SendMessageWithEmojis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:emojis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an example message with emojis to the receipt printer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connector = new FilePrintConnector('/dev/usb/lp0');
        $printer = new Printer($connector);

        $printer->text("Here's some special characters: ⏶ ⌘ ┳ 😀 🥰");
        $printer->feed(4);

        $printer->cut();
        $printer->close();
    }
}
