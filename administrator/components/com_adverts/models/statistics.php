<?php

class ComAdvertsModelStatistics extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('time',	'int')
            ->insert('group',	'int')
            ->insert('date',	'int')
            ;
    }
}