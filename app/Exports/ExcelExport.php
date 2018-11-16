<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Model\Files\Milk;
use App\User;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
 

class ExcelExport implements FromCollection, WithHeadings, ShouldAutoSize

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $milk = Milk::join('requestings', 'requestings.id', '=', 'milks.requesting_id')
        ->join('recipients', 'recipients.id', '=', 'requestings.recipient_id')
        ->join('users', 'users.id', '=', 'recipients.user_id')
        ->select('users.firstname', 'users.lastname', 'batch_number', 'container_number')
        ->get();

        return $milk;
    }

    public function headings() : array
    {
        return [
            'Batch Number',
            'Container Number',
            'Firstname',
            'Lastname',
            


        ];
    }
}
