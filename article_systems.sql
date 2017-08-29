-- auto-generated definition
create table posts
(
	id int(10) unsigned auto_increment
		primary key,
	slug varchar(255) not null,
	title varchar(255) not null,
	content text not null,
	created_at timestamp null,
	updated_at timestamp null,
	publish_at timestamp default '0000-00-00 00:00:00' not null,
	constraint posts_slug_unique
		unique (slug)
)
;

create index posts_publish_at_index
	on posts (publish_at)
;
