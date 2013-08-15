<?php
session_start();
define("WEB_TITLE","软二跳蚤市场"); 
define("SELL_TYPE_NORMAL","0");  //一口价
define("SELL_TYPE_AUCTION_ENGLISH","1");  //英式拍卖
define("SELL_TYPE_AUCTION_DUTCH","2");  //荷兰式拍卖
define("SELL_TYPE_AUCTION_SECRET_HIGH","3");  //密封最高价式拍卖
define("SELL_TYPE_AUCTION_SECRET_CLOSEST","4");  //密封最接近价式拍卖

//英式拍卖(English Auction), 先估计一个底价，然后叫价越来越高；
//荷兰式拍卖(Dutch Auction)，先确定一个高价，然后不停降低叫价直到卖出为止。
//密封式最高价拍卖(Sealed First-Price Auction or First-Price Sealed-Bid Auction(FPSB))：所有的竞标者同时提交出价，这样就谁也无法知晓别人的出价。最后最高价位者中标。
//密封式次高价拍卖(Sealed Second-Price Auction)：只是经济学家维克瑞（Vickery）所鼓吹的，因此又叫Vickery Auction。它和最高价拍卖显著的不同在于，出价第一的人只要付第二高的价格就行啦。Google在出售其广告字（AdWords）时就采用了这种方式，因为他们相信，这么做可以鼓励广告主尽管放手依自己所认定的搜索价值去投标，因为最后支付的价格一定比较低，这样大家出价时也会大方了很多。
function type2txt($mode)
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

function is_admin()
{
    if($_SESSION['tz_userlevel'] >=100)
        return true;
    else
        return false;
}
?>
   