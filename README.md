# OneCode
![OneCode Logo](https://onecode.wuhan5.cc/OneCode%20SUB.png)

一个安全快捷的临时密码生成&amp;登录的 PHP 小程序。可以生成一个临时密码用于登录/双重验证，密码五分钟后过期，使用一次后即失效，安全可靠。
* * *
## 安装
Clone from Github

```
git clone https://github.com/wuhan005/OneCode.git
```

将文件拷贝到网站服务器目录即可。
* * *
## 使用
### 1. 生成新的 OneCode
```
POST https://www.yourwebsite.domain/GenerateKey.php
```
#### 请求参数
`token` （在 config.php 中设置）

`key` （在 config.php 中设置）
#### 返回值
`CODE`

- `200` （成功 返回为新OneCode）

- `501` （错误）

`Message` （信息提示）
* * *

### 2. 验证 OneCode
```
POST https://www.yourwebsite.domain/AuthKey.php
```
#### 请求参数
`onecode`
#### 返回值
`CODE`

- `200` （成功）
- `501` （验证错误）
- `502` （OneCode尝试次数用尽）
- `503` （OneCode已过期）

`Message` （信息提示）

- `Authorization Error! ` 验证错误
- `The Key is Not Available. ` OneCode尝试次数用尽
- `Overtime!` OneCode 已过期

### 3. 配置相关（config.php）
- `$_salt` （加密所使用的 Salt 值）
- `$_token` （验证用 Token）
- `$_key` （验证用 Key，建议为4位数字）

* * *
## 目录文件
* AuthKey.php 验证 OneCode
* GenerateKey.php 生成新的 OneCode
* OneCode.json 用于储存OneCode
* config.php 配置文件
* * *

## 联系我
- E-mail: 524306184@qq.com
- Blog: [https://wuhan5.cc/](https://wuhan5.cc/) 
- QQ: 524306184

* * *

## LICENSE
GNU General Public License v2.0


