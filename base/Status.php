<?php

namespace common\base;

class Status
{
    const Normal = 1; // 正常,开启
    const Close = 2; // 关闭
    const Wait = 3; // 等待中
    const Error = 4; // 错误
    const Failed = 5; // 失败
    const Success = 6; // 成功
    const Queue = 7; // 入队
    const Expire = 8; // 过期
    const Delete = 9; // 删除
}
