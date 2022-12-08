import csv

distance = 0
depth = 0
aim = 0

with open('data.csv', newline='') as csvfile:
    reader = csv.reader(csvfile, delimiter=',')
    for row in reader:
        move = row[0]
        length = int(row[1])

        match move:
            case 'up':
                aim -= length
            case 'down':
                aim += length
            case 'forward':
                distance += length
                depth += length*aim

print(depth*distance)