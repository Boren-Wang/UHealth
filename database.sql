create database uhealth;
use uhealth;

create table patients (
	patient_id int not null AUTO_INCREMENT primary key,
	name varchar(20) not null,
	age int(3) not null,
	height int(3) not null,
	weight int(3) not null,
	gender ENUM ('Male', 'Female') not null
);

create table accelerometer_data (
	epoch bigint zerofill NOT NULL,
	t timestamp not null DEFAULT CURRENT_TIMESTAMP,
	elapsed decimal(5,3) NOT NULL,
	x decimal(4,3) not null,
	y decimal(4,3) not null,
	z decimal(4,3) not NULL,
	patient_id int NOT NULL,
	FOREIGN KEY(patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE
);

drop table patients;
drop table accelerometer_data;

DESCRIBE patients;
DESCRIBE accelerometer_data;

insert into patients (name, age, height, weight, gender) values("A", 18, 175, 75, "Male");
insert into accelerometer_data (epoch, t, elapsed, x, y, z, patient_id) values(00000000000000000000, now(), 6.960, 1.111, -2.222, 3.333, 1);

select * from patients;
select * from accelerometer_data;

SELECT table_schema AS "Database", 
ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS "Size (MB)" 
FROM information_schema.TABLES 
GROUP BY table_schema;