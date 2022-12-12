import csv


matrix = []

with open('data.csv', newline='') as csvfile:
    reader = csv.reader(csvfile, delimiter=',')

    for row in reader:
        x1 = int(row[0])
        y1 = int(row[1])
        x2 = int(row[2])
        y2 = int(row[3])


        while matrix.__len__() < y1 or matrix.__len__() < y2:
            matrix.append([])

        for i in range(0, matrix.__len__()):
            while matrix[i].__len__() < x1 or matrix[i].__len__() < x2:
                matrix[i].append(0)

        if x1 == x2:
            if y1 > y2: step = -1
            else: step = 1

            for i in range(y1, y2+step, step):
                matrix[i-1][x1-1] += 1

        else:
            if y1 == y2:
                if x1 > x2: step = -1
                else: step = 1

                for i in range(x1, x2+step, step):
                    matrix[y1-1][i-1] += 1

            else:
                if x1 > x2: stepx = -1
                else: stepx = 1

                if y1 > y2: stepy = -1
                else: stepy = 1

                j = x1

                for i in range(y1, y2+stepy, stepy):
                    matrix[i-1][j-1] += 1
                    j += stepx


overlaps = 0

for row in matrix:
    for cell in row:
        if cell > 1:
            overlaps += 1

print(overlaps)