CREATE TABLE `users` (
  `userid` mediumint(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `user_level` tinyint(1) UNSIGNED NOT NULL,
  `verified` nvarchar(30) NOT NULL,
) 
--Tạo thuộc tính AUTO_INCREMENT
ALTER TABLE `users`
  MODIFY `id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1