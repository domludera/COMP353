import random, sys

nameFile = open('lists/names.txt','r')


#Student(sid, sname, email)
# format -> sid|sname|email
studentTable = open('tables/student.txt','w')
b = True
i = 0
while True:
    try:    
        name = str(nameFile.readline()).strip('\n')
        if(name==""):
            break
        email = name+"@gmail.com"
        studentTable.write("{}|{}|{}\n".format(i, name, email))
        i += 1
    except:
        print("Unexpected error:", sys.exc_info()[0])
        raise
studentTable.close()




#Enrollment(sid, cid, grade)
#grade is letter F->A
enrollmentTable = open('tables/enrollment.txt','w')


enrollmentTable.close()




#Course(cid, cname, year, term, section, credits)
courseTable = open('tables/course.txt','w')
step = random.randint(1,5)
for j in range(300, 330, step):
    cid = j
    cname = "COMP"
    year = 2019
    term = "Fall" if random.randint(0,3) < 2 else "Winter"
    section = random.randint(1,4)
    credits = random.randint(0,4)
    courseTable.write("{}|{}|{}|{}|{}|{}\n".format(cid, cname, year, term, section, credits))


#Teach(cid, ProfName)
teachTable = open('tables/teach.txt','w')
