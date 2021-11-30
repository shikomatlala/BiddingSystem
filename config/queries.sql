SELECT CURRENT_TIMESTAMP + 3600, CURRENT_TIMESTAMP
FROM DUAL;

-- Returns the date part of the datetime stamp
SELECT startdate, enddate, DATE(startdate)
FROM livestock;

-- Returns the date part of the datetime stamp
SELECT startdate, enddate, TIME(startdate) 
FROM livestock

SELECT startdate, enddate, TIME(startdate) + 23, TIME(startdate)
FROM livestock

ADDDATE()
ADDTIME()
CONVERT_TZ()
CURDATE()
CURRENT_DATE()
CURRENT_TIME()
CURRENT_TIMESTAMP
CURTIME()
DATE_ADD()
DATE() -- Takes the date part out from datetime stamp
DATEDIFF()
DAY() -- Returns the day of the month for a specific date
DAYNAME() -- Returns the name of the week
DAYOFMONTH()
DAYOFYEAR()
DAYOFWEEK()
EXTRACT() -- Extracts a part of a given date
STR_TO_DATE()
SUBDATE()
SUBTIME()
SYSDATE() -- Returns the system date
TIME() -- Extracts the time part of a time or datetime expression as string format
TIMEDIFF() -- Returns the difference between two times
TIMESTAMPDIFF()
TIMESTAMPADD()



-- Find the date difference between the start date and the end date.
SELECT DATEDIFF(enddate, startdate) + ' Days Left' " Days Left"
FROM livestock;

SELECT CONCAT(DATEDIFF(enddate, startdate), 'Days Left') "Days"
FROM livestock;

SELECT CONCAT(DATEDIFF(enddate, startdate), ' Days Left') "Days", CONCAT(TIMEDIFF(enddate, startdate), ' Hours') "Time"
FROM livestock;

