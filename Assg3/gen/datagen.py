import random, sys

nameFile = open('lists/names.txt','r')


#Student(sid, sname, email)
# format -> sid|sname|email
studentTable = open('tables/student.txt','w')
b = True
i = 0
while b:
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
     #b=False

#Enrollment(sid, cid, grade)
enrollmentTable = open('tables/enrollment.txt','w')

#Course(cid, cname, year, term, section, credits)
courseTable = open('tables/course.txt','w')

#Teach(cid, ProfName)
teachTable = open('tables/teach.txt','w')
