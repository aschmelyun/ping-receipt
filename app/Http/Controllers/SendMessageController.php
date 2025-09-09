<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class SendMessageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'message' => 'required|max:1024',
        ], [
            'message.required' => 'You have to write something!',
            'message.max' => 'How did you manage to write something that long?',
        ]);

        $connector = new FilePrintConnector('/dev/usb/lp0');
        $printer = new Printer($connector);

        // let me know something's coming
        $printer->feed(1);
        sleep(2);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setTextSize(2, 2);
        $printer->setEmphasis(true);
        $printer->text("PING");
        $printer->feed(1);
        $printer->setTextSize(1, 1);
        $printer->setEmphasis(false);
        $printer->text('MESSAGE FOR ANDREW SCHMELYUN');
        $printer->feed(2);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text(str_repeat('-', 42));

        $printer->text($request->message);
        $printer->feed(8);

        $printer->cut();
        $printer->close();

        $request->session()->flash('success', 'Your message was sent successfully, woohoo!');

        return redirect()->back();
    }
}
