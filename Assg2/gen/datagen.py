import random, sys, re

studentFileNames = open('lists/names.txt','r')
teacherFileNames = open('lists/teachernames.txt','r')
sidFilter = r"(\d+)|"

#Student(sid, sname, email)
# format -> sid|sname|email
studentTable = open('../sql/tables/student.txt','w')
b = True
i = 0
studentDict = []
while True:
    try:    
        name = str(studentFileNames.readline()).strip('\n')
        if(name==""):
            break
        email = name+"@gmail.com"
        student = "{}|{}|{}".format(i, name, email)
        studentDict.append(student)
        studentTable.write(student+"\n")
        i += 1
    except:
        print("Unexpected error:", sys.exc_info()[0])
        raise
studentTable.close()


#Course(cid, cname, year, term, section, credits)
courseTable = open('../sql/tables/course.txt','w')
step = random.randint(1,3)
courseDict = []
for j in range(300, 350, step):
    cid = j
    cname = "COMP"
    year = 2019
    term = "Fall" if random.randint(0,3) < 2 else "Winter"
    section = random.randint(1,4)
    credits = random.randint(0,4)
    payload = "{}|{}|{}|{}|{}|{}".format(cid, cname, year, term, section, credits)
    courseDict.append(payload)
    courseTable.write(payload+"\n")
courseTable.close()


#Enrollment(sid, cid, grade)
#grade is letter F->A
enrollmentTable = open('../sql/tables/enrollment.txt','w')
for student in studentDict:
    for i in range(5):
        reg = random.randint(0,len(courseDict)-1)
        grade = random.randint(0,6)
        enroll = "{}|{}|{}".format((re.match(sidFilter,student)).group(1),courseDict[reg][:3],grade)
        enrollmentTable.write(enroll+"\n")
enrollmentTable.close()




#primary key -> cid **must be unique
#for each course, theres an arbitrary teacher
#create dictionary of courses, and assign randomly cid to profname
#Teach(cid, ProfName)
teachTable = open('../sql/tables/teach.txt','w')
teachDict = []
teachername = ""
while True:
    teachername = str(teacherFileNames.readline()).strip('\n')
    if(teachername==""):
        break
    else:
        teachDict.append(teachername)

for courses in courseDict:
    rand = random.randint(0, len(teachDict)-1)
    teacher = "{}|{}".format(courses[:3], teachDict[rand])
    teachTable.write(teacher+"\n")

