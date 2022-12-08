file = open('./data', 'r')

data = file.readlines()

previous = 0
greaterThanPrevious = 0

numbers = []

for i in range(0, len(data)):
    numbers.append(int(data[i]))

for i in range(2, len(numbers)):
    sum = numbers[i]+numbers[i-1]+numbers[i-2]

    if sum > previous & previous != 0:
        greaterThanPrevious += 1

    previous = sum



file.close()

print(greaterThanPrevious)