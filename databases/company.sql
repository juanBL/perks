create table company
(
	id char(36) not null
		primary key,
	name varchar(50) not null,
	logo varchar(255) not null,
	number_employees int not null,
	perks json null,
	active boolean default true not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
