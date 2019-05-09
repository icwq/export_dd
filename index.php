<?php
/**
 * User: ChenYingHao 821279143@qq.com
 * Date: 2019/5/9
 * Time: 15:28
 */

//自动加载
spl_autoload_register(function ($class_name) {
    require_once './server/' . $class_name . '.php';
});

$config = require('./config/config.php');
define('DICT',$config['dictionary']);
define('DB',$config['db']);

$dictionary_type = 'create_' . DICT['type'];
$dictionary_type();

//生成html格式数据字典
function create_html()
{
    $table_columns = array();
    $table_data = getTables();
    $column_data = getTableColumns();
    if ($table_data){
        //格式化表字段
        foreach ($column_data as $key => $value){
            $table_columns[$value['TABLE_NAME']][] = $value;
        }
        $dic_obj = DictionaryHtml::getInstance();
        $dic_obj->setTitle(DB['name']);
        $dic_obj->setTableData($table_data);
        $dic_obj->setTableColumnData($table_columns);
        $html = $dic_obj->create();
        $filename = './dictionary/数据字典';
        if(DICT['date_suffix'])
            $filename .= '_' . date('YmdHis');
        $filename .= '.html';
        $file_obj = fopen($filename, "w") or die("Unable to open file!");
        fwrite($file_obj, $html);
        fclose($file_obj);
    }else{
        exit('数据表为空!');
    }
}

//获取所有表信息
function getTables()
{
    //获取DB实例
    $db = Db::getInstance(DB);
    $sql = 'SELECT TABLE_NAME, ENGINE,TABLE_COMMENT FROM information_schema.tables WHERE TABLE_SCHEMA = "' .DB['name']. '"';
    return $db->query($sql);
}

//获取所有表字段信息
function getTableColumns()
{
    //获取DB实例
    $db = Db::getInstance(DB);
    //获取所有表信息
    $sql = 'SELECT TABLE_NAME,COLUMN_NAME,COLUMN_DEFAULT,IS_NULLABLE,COLUMN_TYPE,COLUMN_COMMENT,ORDINAL_POSITION,COLUMN_KEY,EXTRA FROM information_schema.columns WHERE TABLE_SCHEMA = "' .DB['name']. '"';
    return $db->query($sql);
}
