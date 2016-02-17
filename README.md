# Slim 3 Very simple REST Skeleton

This is a simple skeleton project for Slim 3 that implements a simple REST API.
Based on [https://github.com/moritz-h/slim3-rest-skeleton] who is based on [akrabat's slim3-skeleton](https://github.com/akrabat/slim3-skeleton)

## Create Database

```sql
CREATE TABLE IF NOT EXISTS `books` (
`id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;


ALTER TABLE `books`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `books`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
```

I will write further documentation.