<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/29
 * Time: 19:20
 */

namespace app\index\controller;
use think\Controller;


class Page extends Controller
{
    public function index(){
        return $this->fetch();
    }
    public function page(){
        //向前台展示的数据有分页数，总页数，分页展示品的id,图片路径
        $colum = 4;
        $total = db('images')->count();
        $pageNum = ceil($total/$colum);

        $varPage = !empty($_GET['page'])?intval($_GET['page']):1;

        //前台点击页数开始展示商品的开始id
        $start = ($varPage-1) * $colum;

        //定义返回前台的数据
        $result = [
            'colum'   => $colum,
            'pageNum' => $pageNum,
            'total'   => $total,
            'list'    =>array()
        ];
        $data = db('images')->where('id','>',$start)->limit($colum)->select();
        foreach($data as $v){
            $result['list'][]=array(
                'id' => $v['id'],
                'img_url'=>$v['img_url']
            );
        }
        return json_encode($result);
    }


}