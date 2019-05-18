<?php

namespace App\Exports;

use App\bondg;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BondgExports implements FromView
{
    public function view(): View
    {
        return view('admin.status-bondg', [
            'bondg' => bondg::all(),
        ]);
    }
}