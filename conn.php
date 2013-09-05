<?php
session_start();
define("WEB_TITLE","软二跳蚤市场"); 
define("SELL_TYPE_NORMAL","0");  //一口价
define("SELL_TYPE_AUCTION_ENGLISH","1");  //英式拍卖
define("SELL_TYPE_AUCTION_DUTCH","2");  //荷兰式拍卖
define("SELL_TYPE_AUCTION_SECRET_HIGH","3");  //密封最高价式拍卖
define("SELL_TYPE_AUCTION_SECRET_CLOSEST","4");  //密封最接近价式拍卖

define("ITEM_CLOSE_NORMAL","0");
define("ITEM_CLOSE_SOLD","1");
define("ITEM_CLOSE_CANCEL","2");
define("ITEM_CLOSE_TIMEOUT","3");

//英式拍卖(English Auction), 先估计一个底价，然后叫价越来越高；
//荷兰式拍卖(Dutch Auction)，先确定一个高价，然后不停降低叫价直到卖出为止。
//密封式最高价拍卖(Sealed First-Price Auction or First-Price Sealed-Bid Auction(FPSB))：所有的竞标者同时提交出价，这样就谁也无法知晓别人的出价。最后最高价位者中标。
//密封式次高价拍卖(Sealed Second-Price Auction)：只是经济学家维克瑞（Vickery）所鼓吹的，因此又叫Vickery Auction。它和最高价拍卖显著的不同在于，出价第一的人只要付第二高的价格就行啦。Google在出售其广告字（AdWords）时就采用了这种方式，因为他们相信，这么做可以鼓励广告主尽管放手依自己所认定的搜索价值去投标，因为最后支付的价格一定比较低，这样大家出价时也会大方了很多。


function getSellType($mode)
{
    $mode2txt = " ";
    switch ($mode)
    {
        case SELL_TYPE_NORMAL:
            $mode2txt = "一口价";
            break;
        case SELL_TYPE_AUCTION_ENGLISH:
            $mode2txt = "英式拍卖";
            break;
        case SELL_TYPE_AUCTION_DUTCH:
            $mode2txt = "荷兰式拍卖";
            break;
        case SELL_TYPE_AUCTION_SECRET_HIGH:
            $mode2txt = "密封最高价式拍卖";
            break;
        case SELL_TYPE_AUCTION_SECRET_CLOSEST:
            $mode2txt = "密封最接近价式拍卖";
            break;
        default:
            $mode2txt = "无";
            break;
    } 
    return $mode2txt;
}

//商品状态
//0 -- 正常状态
//1 -- 已经售出
//2 -- 已经取消
//3 -- 过期

function getItemClose($status)
{
    $status2txt = " ";
    switch ($status)
    {
        case ITEM_CLOSE_NORMAL:
            $status2txt = "正常状态";
            break;
        case ITEM_CLOSE_SOLD:
            $status2txt = "交易完成";
            break;
        case ITEM_CLOSE_CANCEL:
            $status2txt = "交易取消";
            break;
        case ITEM_CLOSE_TIMEOUT:
            $status2txt = "交易过期";
            break;
        default:
            $status2txt = "无";
            break;
    } 
    return $status2txt;
}

function getSellTypeURL($ItemSellType)
{
    $detailURL = "";
    switch($ItemSellType)
    {
        case SELL_TYPE_NORMAL:
            $detailURL = "item_detail_normal.php";
            break;
        case SELL_TYPE_AUCTION_ENGLISH:
            $detailURL = "item_detail_auction_english.php";
            break;
        case SELL_TYPE_AUCTION_DUTCH:
            $detailURL = "item_detail_auction_dutch.php";
            break;
        case SELL_TYPE_AUCTION_SECRET_HIGH:
            $detailURL = "item_detail.php";
            break;
        case SELL_TYPE_AUCTION_SECRET_CLOSEST:
            $detailURL = "item_detail.php";
            break;
        default:
            $detailURL = "";
            break;
    }
    return $detailURL;
}

function is_admin()
{
    if($_SESSION['tz_userlevel'] >=100)
        return true;
    else
        return false;
}
?>
   