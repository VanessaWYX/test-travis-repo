create TABLE accountData (
        friend_id int ,
        friend_email varchar(50) not null,
        password varchar(20) not null,
        profile_name varchar(30) not null,
        date_started date not null,	
        num_of_friends int null,
        PRIMARY KEY (friend_id)
        );

-- create TABLE myfriends(
-- 	friend_id1 int not null,
-- 	friend_id2 int not null
-- );

-- drop TABLE account;

