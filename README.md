## 说明

这是为 onedrive 云盘程序[OneManager](https://github.com/qkqpttgf/OneManager-php)写的一个简单的 css 主题，参考了 OneIndex 的主题样式。

## 使用

- OneManager 程序已内置 onemoe-css.php 文件，后台启用 onemoe 主题即可。
- 本主题可以自定义背景渐近色，在后台设置背景图片的地方，将 background 设置为类似下面的渐近色 css 代码即可。

```css
background-color: #8ec5fc;
background-image: linear-gradient(62deg, #8ec5fc 0%, #e0c3fc 100%);
```

> 什么？你不会渐近色代码？放心，我也不会，只需要从类似下面的一些渐近色配色网站 copy css 然后粘贴过来即可。  
> 配色网站 1：https://www.grabient.com/  
> 配色网站 2：https://gradient.shapefactory.co/

以下为手动配置

- 向程序 theme 文件夹里添加 onemoe.php 或 onemoe-css.php 文件，网站后台切换主题即可。
- 其中 onemoe.php 中 css 文件默认放在我的网站上并提供百度 cdn 加速，如果自行下载修改 css 文件，可以将 修改后的 onemoe.css 添加到你的 od 网盘或者 cdn 上，然后将其地址替换掉 onemoe.php 中约 13 行处的地址。
- 其中 onemoe-css.php 只是将 css 内置内部样式而已。
- 更多细节请访问 [我的博客](https://www.2bboy.com/archives/154.html)。

## 预览

- [在线预览](https://pan.2bboy.com/Public)

![](https://files.catbox.moe/c01dkj.jpg)
![](https://files.catbox.moe/bxz8b2.jpg)
