<?php 

namespace App\Models\Traits;

/**
 * Template created_at, updated_at for models 
 */
trait DateFormat
{
    private function dateFormat(string $column, string $format):string
    {
        if(!empty($this->$column) && ($column === 'created_at' || $column === 'updated_at')) {
            return (string) $this->$column->format($format);
        } 
        return '';
    }

    
    public function createItem(string $format = 'd-m-Y H:i'):string
    {
        return $this->dateFormat('created_at', $format);
    }


    public function updateItem(string $format = 'd-m-Y H:i'):string
    {
        return $this->dateFormat('updated_at', $format);
    }
    
}
