# Laravel Table Builder

### Use
  - Add `App\Providers\TableBuilderProvider::class` to providers in config/app.php
  - Add `TableBuilder' => App\Html\TableBuilder::class,` to aliases in config/app.php
  - In a view:
```
{!! TableBuilder::render($collection, 
    [
        'tableColumns' => [
            'name' => 'Name', 
            'file_name' => 'File Name', 
            'storage_name' => 'Storage Name'
        ],
        'tableAttributes' => [
            'tableId' => 'tbl-datatable',
            'tableName' => 'tbl-name',
            'tableClass' =>'table table-hover table-condensed'
        ]
    ]) 
!!}
```
