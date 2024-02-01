<?php

namespace Obelaw\UI\Renderer\Grid;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;
use Obelaw\UI\Renderer\Grid\Grid;

class Export implements FromCollection, Responsable
{
    use Exportable;

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function __construct(private Grid $gridModel)
    {
        $this->fileName = now() . '.xlsx';
    }

    public function collection()
    {
        $query = $this->gridModel->getModel()::query();

        $query->where(function (Builder $query) {
            if ($this->gridModel->getWhere()) {
                $query->where((new $this->gridModel->getWhere())->where($query));
            }

            if (method_exists($this->gridModel->grid, 'where')) {
                $query->where($this->gridModel->grid->where($query));
            }
        });

        return $query->get();
    }
}
