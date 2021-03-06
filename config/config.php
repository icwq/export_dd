<?php
/**
 * User: ChenYingHao 821279143@qq.com
 * Date: 2019/5/9
 * Time: 15:28
 */

return [

    // +---------------------------------------------------------
    // | 字典设置
    // +---------------------------------------------------------

    // 导出数据字典格式(后期扩展)
    'dictionary' => [
        'type'              => 'html',  //目前只支持html，后面会扩展

        'date_suffix'              => true,  // 后缀,true可以添加日期后缀
    ],

    // +---------------------------------------------------------
    // | 数据库设置
    // +---------------------------------------------------------
    'db' => [
        'host'              => '127.0.0.1', // 主机地址

        'user'              => 'root',  // 用户名

        'pass'              => '123456',    // 密码

        'name'              => 'vue-admin', // 数据库名称

        'port'              => '3306',  // 端口

        'charset'              => 'utf8',   //编码
    ]
];
