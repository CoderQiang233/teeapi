<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/26
 * Time: 14:34
 */
class Model_Member extends PhalApi_Model_NotORM
{
    const ORDER_STATUS_1 = 1; // 已支付
    public function getMemberList($data)
    {
        $pageSize='';//每页条数

        $pageIndex='';//当前页


        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;

        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;

        }

        $start_page=$pageSize*($pageIndex-1);

        $name = $data->name;

        $phone = $data->phone;

        $level=$data->level;

        $where = '';

       $select = DI()->notorm->members;
       
        if ('undefined' !== $name && '' !== $name && null !== $name) {
            $where = $where . ' AND name="' . $name . '"';
            $select = $select->where('name', $name);
        }
        if ('undefined' !== $phone && '' !== $phone && null !== $phone) {
            $where = $where . ' AND phone="' . $phone . '"';
            $select = $select->where('phone', $phone);
        }
        if($level){
            $where=$where.'AND level="'.$level.'"';

            $total=count($select->where(array("flag"=>Model_Member::ORDER_STATUS_1,'level'=>$level)));
        }else{
            $total=count($select->where("flag",Model_Member::ORDER_STATUS_1));
        }


        $sql='SELECT m.*,ma.address '
            .'FROM members m LEFT JOIN members_address ma '
            .'ON m.id=ma.member_id '
            .' WHERE 1=1 AND flag=1 '.$where
            .'ORDER BY m.level desc,m.id LIMIT :start_page ,:pageSize';



        $params = array(':pageSize' => intval($pageSize),':start_page' =>$start_page);

        $rows = $this->getORM()->queryAll($sql, $params);
        //通过遍历拿到推荐人手机号作为查询条件查询出推荐人姓名
        for ($i=0;$i<count($rows);$i++){
            $referee_phone=trim($rows[$i]['referee_phone'],"");
            if ('undefined' != $referee_phone && '' != $referee_phone && null != $referee_phone&&" "!= $referee_phone) {
                $namesql='SELECT name FROM members Where phone='.$referee_phone;
                $names=$this->getORM()->queryAll($namesql, array());
                if($names){
                    $rows[$i]['referee_name']=$names[0]['name'];
                }else{
                    $rows[$i]['referee_name']='';
                }


            }



        }



        $arry = array(
            'list' => $rows,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );
        return $arry;

    }
  public function getMemberLevelCount($data)
  {
      $hy=count(DI()->notorm->members->where(array("flag" =>Model_Member::ORDER_STATUS_1 ,"level"=>1))->fetchAll());
      $ck=count(DI()->notorm->members->where(array("flag" => Model_Member::ORDER_STATUS_1,"level"=>2))->fetchAll());
      $mz=count(DI()->notorm->members->where(array("flag" => Model_Member::ORDER_STATUS_1,"level"=>3))->fetchAll());
      $hhr=count(DI()->notorm->members->where(array("flag" => Model_Member::ORDER_STATUS_1,"level"=>4))->fetchAll());

      $levelinfo=array(
          array('x'=> '会员','y'=>$hy),
          array('x'=> '创客','y'=>$ck),
          array('x'=> '盟主','y'=>$mz),
          array('x'=> '合伙人','y'=>$hhr),

      );

      return $levelinfo;
  }
}