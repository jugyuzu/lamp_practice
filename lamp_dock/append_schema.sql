--注文したユーザー
CREATE TABLE `order_master` (
    `order_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `log_id` int(11) NOT NULL,
    PRIMARY KEY(order_id)
);
--注文内容
CREATE TABLE `order_content` (
    `order_id` int(11) NOT NULL,
    `item_id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `price` int(11) NOT NULL,
    `amount` int(11) NOT NULL
);