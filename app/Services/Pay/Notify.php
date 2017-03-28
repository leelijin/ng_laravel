<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/2/15
 * Time: 16:15
 */

namespace App\Services\Pay;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class Notify implements \Payment\Notify\PayNotifyInterface
{
    
    /**
     * 异步回调检验完成后，回调客户端的业务逻辑
     *  业务逻辑处理，必须实现该类。
     *
     * @param array $data 返回的数据
     *
     * @return boolean
     * @author helei
     */
    public function notifyProcess(array $data)
    {
        if($data)Order::whereOrderIdAndStatus($data['order_no'],0)->update(['status'=>1,'transaction_id'=>$data['transaction_id']]);
        return true;
    }
}