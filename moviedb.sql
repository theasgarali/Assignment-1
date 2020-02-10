

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `keywords` */

insert  into `keywords`(`id`,`user_id`,`keyword`) values 
(2,1,'fghj'),
(3,1,'32');

/*Table structure for table `movies` */

CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `description` text,
  `rating` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `movies` */

insert  into `movies`(`id`,`name`,`image`,`description`,`rating`) values
(1,'Django','images/django.jpg','When Django, a slave, is freed, he joins forces with a bounty hunter to rescue his wife, who has been captured by a hard-hearted plantation owner.','5'),
(2,'Finding Nemo','images/nemo.jpg','It tells the story of an overprotective clownfish named Marlin, who, along with a regal blue tang named Dory searches for his missing son Nemo.','3'),
(3,'The Lion King','images/lionking.jpg','After the murder of his father, a young lion prince flees his kingdom only to learn the true meaning of responsibility and bravery.','5'),
(4,'Coco','images/coco.jpg','Coco is a kids movie about hope.','2'),
(5,'It','images/it.jpg','A horror movie....','5'),
(6,'AI','images/ai.jpg','A horror movie....','5'),
(7,'Star Wars','images/starwars.jpg','Star Wars is an American epic space-opera media franchise.','5'),
(8,'Dr Sleep','images/drsleep.jpg','Struggling with alcoholism, Dan Torrance remains traumatized by the sinister events that occurred at the Overlook Hotel when he was a child.','5'),
(9,'Avengers','images/avengers.jpg','After Thanos, an intergalactic warlord, disintegrates half of the universe, the Avengers must reunite and assemble again to reinvigorate their trounced allies and restore balance.','5'),
(10,'SkyFall','images/skyfall.jpg','','5'),
(11,'Lord of the Rings','images/lord.jpg','Edit here...','5'),
(12,'X Men','images/xmen.jpg','Edit here....','5'),
(13,'Dark Knight','images/darkknight.jpg','Edit here....','5'),
(14,'Paddington','images/paddington2.jpg','Edit here....','5'),
(15,'Planet of the Apes','images/planetoftheapes.jpg','Edit here....','5'),
(16,'Kingdom','images/kingdom.jpg','Edit here....','5');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`type`) values 
(1,'Main Admin','admin@gmail.com','123456','admin'),
(10,'Normal User','user@user.com','password',''),
(11,'Jason','jason@gmail.com','password','user'),
(12,'Jason','jason@outlook.com','password','user');

/*Data for the table `auth_history` */

CREATE TABLE `auth_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;