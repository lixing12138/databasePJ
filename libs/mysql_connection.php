<?php
/**
 * Created by PhpStorm.
 * User: lixin
 * Date: 2019/1/2
 * Time: 18:42
 */
require_once __DIR__.'/../config.php';

function get_connection()
{
    global $sql_user;
    global $sql_password;
    global $dsn;
    try {
        $con = new PDO($dsn, $sql_user, $sql_password);
        $con->exec("SET NAMES ''utf8");
        return $con;
    } catch (PDOException $e){
        print $e->getMessage();
            return null;
    }

}
//插入数据
function insert_table($con, $table, $dict)
{
    $num = sizeof($dict);
    $sql_header = "INSERT INTO " . $table . "(";
    $sql_tail = ") VALUES (";
    $keys = array_keys($dict);
    for ($i = 0; $i < $num; $i++) {
        if ($i == $num - 1) {
            $sql_tail .= "?";
            $sql_header .= $keys[$i];
        } else {
            $sql_header .= $keys[$i] . ", ";
            $sql_tail .= "?, ";
        }
    }
    $sql = $sql_header . $sql_tail . ")";
    $stmt = $con->prepare($sql);

    for ($i = 0; $i < $num; $i++) {
        $stmt->bindParam($i + 1, $dict[$keys[$i]]);
    }
    return $stmt->execute();
}

/*
 * 用于更新数据库
 * @param table         为表名
 * @param keys          为表中属性名
 * @param values        为属性对应值
 * @param cond_key      更新项的唯一键名
 * @param cond_value    更新项的唯一键值
 */
function update_table($con, $table, $dict, $cond_key, $cond_value)
{
    $num = sizeof($dict);
    $sql_header = "UPDATE " . $table . " SET ";
    $keys = array_keys($dict);
    for ($i = 0; $i < $num; $i++) {
        if ($i == $num - 1)
            $sql_header .= $keys[$i] . "=? ";
        else
            $sql_header .= $keys[$i] . "=?, ";
    }
    $sql = $sql_header . "WHERE " . $cond_key . "=?";
    //echo $sql . "\n";
    $stmt = $con->prepare($sql);
    for ($i = 0; $i < $num; $i++) {
        $stmt->bindParam($i + 1, $dict[$keys[$i]]);
    }
    $stmt->bindParam($num + 1, $cond_value);
    return $stmt->execute();
}

//使用等于条件进行查找
function select_table_condition($con, $table, $dict)
{
    $num = sizeof($dict);
    $sql = "SELECT * FROM " . $table;
    $keys = array_keys($dict);
    if ($num > 0) {
        $sql .= " WHERE ";
        for ($i = 0; $i < $num; $i++) {
            if ($i == $num - 1)
                $sql .= $keys[$i] . " = ? ";
            else
                $sql .= $keys[$i] . " = ? AND ";
        }
    }
    $stmt = $con->prepare($sql);
    for ($i = 0; $i < $num; $i++) {
        $stmt->bindParam($i + 1, $dict[$keys[$i]]);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//等于条件查找单条记录
function select_table_condition_single($con, $table, $dict)
{
    $res = select_table_condition($con, $table, $dict);
    if (sizeof($res) == 0)
        return null;
    return $res[0];
}

function delete_table($con,$table,$key,$value){
    $sql="DELETE from ".$table." WHERE ".$key."=".$value;
    $stmt = $con->prepare($sql);
    return $stmt->execute();
}
?>