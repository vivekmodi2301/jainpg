SELECT sum(collegefunddte.fees) as fees FROM collegefunddte where funds=1 and  sid in (select sid from studentfees where cid=2 and extrafees like 'computer application-%') 