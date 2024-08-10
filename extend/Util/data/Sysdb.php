<?php

namespace Util\data;

use think\facade\Db;

class Sysdb{

    public $where;
    public $field;
    public $order;
    // public $table;
    // public $wherelike;

    public function table($table){
        $this->where = array();
        $this->field = '*';
        $this->order = '';
        $this->wherelike = '';

        $this->table = $table;
        return $this;
    }

    public function field($field = '*'){
        $this->field = $field;
        return $this;
    }

    public function order($order){
        $this->order = $order;
        return $this;
    }

    public function where($where = array()){
        $this->where = $where;
        return $this;
    }

    public function item(){
        $item = Db::name($this->table)->field($this->field)->where($this->where)->find();
        return $item ? $item : false;
    }

    public function lists(){
        $lists = Db::name($this->table)->field($this->field)->where($this->where)->order($this->order)->select();
        return $lists ? $lists : false;
    }

    public function insert($data){
		$res = Db::name($this->table)->insert($data);
		return $res;
	}

	public function update($data){
		$res = Db::name($this->table)->where($this->where)->update($data);
		return $res;
	}

	public function delete(){
		$res = Db::name($this->table)->where($this->where)->delete();
		return $res;
	}

    public function pages($pageSize = 10){
		$total = Db::name($this->table)->where($this->where)->count();
		$query = Db::name($this->table)->field($this->field)->where($this->where);
		$this->order && $query = $query->order($this->order);
		$data = $query->paginate($pageSize,$total);
		return array('total'=>$total,'lists'=>$data->items(),'pages'=>$data->render());
	}

    public function showsql(){
        return Db::name($this->table)->where($this->where)->buildSql();
    }
}