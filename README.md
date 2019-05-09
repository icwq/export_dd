export_dd
===============

export_data_dictionary

> export_dd的运行环境要求PHP5.4以上。

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录
├─config                配置目录
│  ├─config.php         配置文件
│
├─dictionary            导出的数据字典
├─extend                扩展类库目录         授权说明文件
├─server                PHP核心代码
├─README.md             README 文件
├─index.php             执行文件
~~~

## 使用
在index.php目录执行 php index.php


## 文档
1,配置文件

config/config.php,

+ type : 设置为其他格式的数据字典(后期会扩展，目前只支持html)
+ date_suffix : 为true时导出的数据字典会加上日期后缀
~~~
'dictionary' => [
        'type'              => 'html', 

        'date_suffix'              => true, 
    ],
~~~


