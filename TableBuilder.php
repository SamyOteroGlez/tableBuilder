<?php

namespace App\Html;

/**
 * Description of TableBuilder
 *
 * @author tesa
 */
class TableBuilder
{
    private $row;
    protected $html = '';
    protected $options;
    protected $collection;
    protected $htmlOptions;    
    protected $tableColums;
    
    protected $tableId;
    protected $tableName;
    protected $tableClass;
    
    protected $tableTheadId;
    protected $tableTheadClass;
    
    protected $tableTbodyId;
    protected $tableTbodyClass;
    
    protected $tableTrId;
    protected $tableTrClass;
    
    protected $tableThId;
    protected $tableThClass;
    
    protected $tableTdId;
    protected $tableTdClass;
    
    /**
     * Create new instance of the TableBuilder.
     *
     * @return \App\Html\TableBuilder
     */
    public function newInstance()
    {
        return new TableBuilder;
    }

    static public function render($collection, $htmlOptions = [], $options = [])
    {
        $table = new TableBuilder;
        $table->setAttributes($collection, $htmlOptions, $options)
            ->renderTable();
    }
    
    public function setAttributes($collection, $htmlOptions = [], $options = [])
    {
        return $this->setCollection($collection)
            ->setOptions($options)
            ->setHtmlOptions($htmlOptions)
            ->setTableColumns()
            ->setTableAttributes();
    }
    
    public function setCollection($collection)
    {
        $this->collection = $collection;
        
        return $this;
    }
    
    public function setOptions($options = [])
    {
        $this->options = $options;
        
        return $this;
    }
    
    public function setHtmlOptions($htmlOptions = [])
    {
        $this->htmlOptions = $htmlOptions;
        
        return $this;
    }
    
    public function setTableColumns($columns = [])
    {
        if (0 == count($columns)) {
            
            if (isset($this->htmlOptions['tableColumns'])) {
                $this->tableColums = $this->htmlOptions['tableColumns'];
            }            
        }
        else {
            $this->tableColums = $columns;
        }
        
        return $this;
    }
    
    public function setTableAttributes($attributes = [])
    {
        if (0 == count($attributes)) {
            
            if (isset($this->htmlOptions['tableAttributes'])) {
                $this->tableAttributes($this->htmlOptions['tableAttributes']);
            }            
        }
        else {
            $this->tableAttributes($attributes);
        }
        
        return $this;
    }
    
    private function tableAttributes($attributes)
    {
        if (isset($attributes['tableId'])) {
            $this->setTableId($attributes['tableId']);
        }

        if (isset($attributes['tableName'])) {
            $this->setTableName($attributes['tableName']);
        }

        if (isset($attributes['tableClass'])) {
            $this->setTableClass($attributes['tableClass']);
        }
    }
    
    public function setTableId($id)
    {
        $this->tableId = $id;
        
        return $this;
    }
    
    public function setTableName($name)
    {
        $this->tableName = $name;
        
        return $this;
    }

    public function setTableClass($class)
    {
        $this->tableClass = $class;
        
        return $this;
    }

    protected function renderTable()
    {
        $this->openTag('table', "id='$this->tableId' name='$this->tableName' class='$this->tableClass'")
            ->openTag('thead', "id='$this->tableTheadId' class='$this->tableTheadClass'")
            ->renderTheadContent()
            ->closeTag('thead')
            ->openTag('tbody', "id='$this->tableTbodyId' class='$this->tableTbodyClass'")
            ->renderTbody()
            ->closeTag('tbody')
            ->closeTag('table');
        
        echo $this->html;
    }
    
    protected function renderTheadContent()
    {
        $this->row = $this->getOpenTag('tr');
        
        foreach ($this->tableColums as $column) {
            $this->row = $this->row . $this->getOpenTag('th');
            $this->row = $this->row . $column;
            $this->row = $this->row . $this->getCloseTag('th');
        }
        
        $this->html = $this->html . $this->row . $this->getCloseTag('tr');
        
        return $this;
    }
    
    protected function renderTbody()
    {
        foreach ($this->collection as $model) {
            $this->row = $this->getOpenTag('tr');
            
            foreach ($this->tableColums as $attribute => $label) {
                $this->row = $this->row . $this->getOpenTag('td');
                $this->row = $this->row . $model->$attribute;
                $this->row = $this->row . $this->getCloseTag('td');
            }            
            $this->html = $this->html . $this->row . $this->getCloseTag('tr');
        }
                
        return $this;
    }
    
    private function openTag($tag, $attr = null)
    {
        $this->html = $this->html . $this->getOpenTag($tag, $attr);
        
        return $this;
    }
    
    private function closeTag($tag)
    {
        $this->html = $this->html . $this->getCloseTag($tag);
        
        return $this;
    }
    
    private function getOpenTag($tag, $attr = null)
    {
        return "<$tag $attr>";
    }
    
    private function getCloseTag($tag)
    {
        return "</$tag>";
    }
}
