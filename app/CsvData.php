<?php

namespace voting_system;

use Illuminate\Database\Eloquent\Model;

class CsvData extends Model
{
    protected $table = "csv_data";

    protected $fillable = ['csv_filename', 'csv_header', 'csv_data'];
}
