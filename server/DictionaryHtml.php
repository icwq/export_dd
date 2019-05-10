<?php
/**
 * User: ChenYingHao 821279143@qq.com
 * Date: 2019/5/9
 * Time: 16:06
 */

class DictionaryHtml
{
    protected static $_instance = null;
    protected $title;   //数据库名称
    protected $tables;   //数据表数量
    protected $tableColumns;   //表结构数据


    private function __construct(){}

    /**
     * 防止克隆
     *
     */
    private function __clone() {}

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function setTableData($data)
    {
        $this->tables = $data;
    }

    public function setTableColumnData($data)
    {
        $this->tableColumns = $data;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function create()
    {
        ob_start();

        echo '<html><head><title>数据库设计文档 -- ' . $this->title . '</title><style type="text/css">body, td {font-family: verdana;font-size: 12px;line-height: 150%;}  table {width: 100%;background-color: #ccc;margin: 5px 0;}  td {background-color: #fff;padding: 3px;padding-left: 10px;}  thead td {text-align: center;font-weight: bold;background-color: #eee;}  a:link, a:visited, a:active {color: #015FB6;text-decoration: none;}  a:hover {color: #E33E06;}</style><head><body style="text-align:center;width: 800px;margin: 0 auto;text-align: left;padding-bottom: 80px;"><a name="index"/>
    <H2 style="text-align:center; line-height:50px;">数据库设计文档</H2>
    <div><b>数据库名：'.$this->title.'</b></div><table cellspacing="1" cellpadding="0"><thead><tr><td style="width:40px; ">序号</td><td>表名</td><td>说明</td></tr></thead>';

        if($this->tables){
            foreach ($this->tables as $k => $v){
                $num = $k +1 ;
                echo '<tr><td style="text-align:center;">'.$num.'</td><td><a href="#'. $v['TABLE_NAME'] .'">'.$v['TABLE_NAME'].'</a></td><td>'.$v['TABLE_COMMENT'].'</td></tr>';
            }
        }

        echo '</table><a name="ke_action"/>';

        if($this->tables){
            foreach ($this->tables as $k1 => $v1){
                echo '<a name="'.$v1['TABLE_NAME'].'"/>
    <div style="margin-top:30px;"><a href="#index" style="float:right; margin-top:6px;">返回目录</a><b>表名：'.$v1['TABLE_NAME'].'</b></div><div>说明：'. $v1['TABLE_COMMENT'] .'</div>
    <div>数据列：</div>';

                echo '<table cellspacing="1" cellpadding="0"><thead><tr><td style="width:40px; ">序号</td><td>名称</td><td>数据类型</td><td>索引</td><td>扩展</td><td>允许空值</td><td>默认值</td><td>说明</td></tr></thead>';

                if(array_key_exists($v1['TABLE_NAME'],$this->tableColumns)){
                    foreach ($this->tableColumns[$v1['TABLE_NAME']] as $k2 => $v2){
                        echo '<tr>
            <td style="text-align:center;">'. $v2['ORDINAL_POSITION'].'</td><td>'.$v2['COLUMN_NAME'].'</td><td align="center">'.$v2['COLUMN_TYPE'] .'</td><td align="center">'. $v2['COLUMN_KEY'] .'</td><td align="center">'. $v2['EXTRA'] .'</td><td align="center">' . $v2['IS_NULLABLE'] . '</td><td align="center">'. $v2['COLUMN_DEFAULT'] .'</td><td>'. $v2['COLUMN_COMMENT'] .'</td></tr>';
                    }
                }

                echo  '</table>';
            }
        }

        echo '</body></html>';

        $str = ob_get_clean();
        return $str;
    }



}
