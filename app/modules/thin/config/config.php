<?php

return new \Phalcon\Config(array(
    'startTime' => empty($_SERVER['vivo']) ? mktime(0, 0, 0, 11, 11, 2014) : mktime(12, 0, 0, 11, 1, 2014),
    'endTime' => mktime(23, 59, 59, 11, 1, 2014),

    'weiboTemplate' => '有才就是任性！我制作的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友。#DIY创意手机，和X5Max拼薄#不服你也来创作，赢vivo手机大奖。活动链接：{URL} @vivo智能手机',
    'shareTemplate' => '制作的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友，我就是DIY小能手。#DIY创意手机，和X5Max拼薄#赢vivo手机。薄动心弦X5Max，小伙伴一起来High！活动链接：{URL} {FRIENDS}',

    'templates' => array(
        '6.55mm' => array(
            'text1' => '哇塞！拼出的手机厚度居然是vivo X1的厚度：6.55mm！',
            'text2' => '快给自己点个赞。',
        ),
        '5.75mm' => array(
            'text1' => '你DIY的手机厚度是5.75mm，和vivo X3一样。',
            'text2' => '相信X5Max也一定能带给你惊喜！',
        ),
        array(
            'max' => 10,
            'min' => 9,
            'text1' => '你DIY的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友。',
            'text2' => '这个厚度都可以做板砖了！你确定要这样的手机吗？',
        ),
        array(
            'max' => 9,
            'min' => 8,
            'text1' => '你DIY的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友。',
            'text2' => 'DIY这种事呢，还是要讲究技巧的。这么厚的手机，怎么和X5Max拼薄呢…',
        ),
        array(
            'max' => 8,
            'min' => 7,
            'text1' => '你DIY的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友。',
            'text2' => '所有不以薄为目的的DIY，都是在耍流氓！',
        ),
        array(
            'max' => 7,
            'min' => 6,
            'text1' => '你DIY的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友。',
            'text2' => '所以问题就来了，X5Max到底有多薄？',
        ),
        array(
            'max' => 6,
            'min' => 5,
            'text1' => '你DIY的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友。',
            'text2' => '简直就是中华DIY小当家！可惜还是没有X5Max薄，就是这么任性！',
        ),
        array(
            'max' => 5,
            'min' => 4,
            'text1' => '我天！你DIY的手机厚度为{THICKNESS}mm，打败了全国{KO}%的网友。',
            'text2' => '已经接近X5Max的厚度了，但，还是有差距。加油^^',
        ),
    ),
    'components' => array(
        'a' => array(
            'id' => 'a',
            'name' => '主板',
            'items' => array(
                1 => array('id' => 'a1', 'name' => '单面L型板', 'thickness' => 0.20),
                2 => array('id' => 'a2', 'name' => '双面U型板', 'thickness' => 0.30),
                3 => array('id' => 'a3', 'name' => '双面断板', 'thickness' => 0.35),
                4 => array('id' => 'a4', 'name' => '双面断板', 'thickness' => 0.35),
            ),
        ),

        'b' => array(
            'id' => 'b',
            'name' => '中框',
            'items' => array(
                1 => array('id' => 'b1', 'name' => 'iPhone6', 'thickness' => 4.74),
                2 => array('id' => 'b2', 'name' => 'X3', 'thickness' => 3.95),
                3 => array('id' => 'b3', 'name' => 'iPhone5S', 'thickness' => 7.10),
                4 => array('id' => 'b4', 'name' => 'X1', 'thickness' => 4.55),
            ),
        ),

        'c' => array(
            'id' => 'c',
            'name' => '电池',
            'items' => array(
                1 => array('id' => 'c1', 'name' => 'iPhone6 Plus', 'thickness' => 0.20),
                2 => array('id' => 'c2', 'name' => 'OPPO', 'thickness' => 1.00),
                3 => array('id' => 'c3', 'name' => '荣耀6', 'thickness' => 0.15),
                4 => array('id' => 'c4', 'name' => '三星Note4', 'thickness' => 0.60),
            ),
        ),

        'd' => array(
            'id' => 'd',
            'name' => '后盖',
            'items' => array(
                1 => array('id' => 'd1', 'name' => '玻璃', 'thickness' => 0.40),
                2 => array('id' => 'd2', 'name' => '不锈钢', 'thickness' => 0.30),
                3 => array('id' => 'd3', 'name' => '铝合金', 'thickness' => 0.60),
                4 => array('id' => 'd4', 'name' => '塑胶', 'thickness' => 0.80),
            ),
        ),

        'e' => array(
            'id' => 'e',
            'name' => '屏幕',
            'items' => array(
                1 => array('id' => 'e1', 'name' => 'Incell超薄屏', 'thickness' => 0.20),
                2 => array('id' => 'e2', 'name' => '超薄屏', 'thickness' => 0.60),
                3 => array('id' => 'e3', 'name' => '超纤薄屏', 'thickness' => 0.50),
                4 => array('id' => 'e4', 'name' => '至薄屏', 'thickness' => 0.40),
            ),
        ),
    ),
));