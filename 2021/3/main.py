file = open('./data', 'r')

bitCount = []
first = True

for binary in file:
    char = 0
    for bit in binary.rstrip():
        if first:
            tmp = {'0': 0, '1': 0}
            tmp[bit] += 1
            bitCount.append(tmp)
        else:
            bitCount[char][bit] += 1
            char += 1
    
    first = False

gamma = 0
epsilon = 0
length = bitCount.__len__()

for i in range(0, length):
    if bitCount[i]['1'] > bitCount[i]['0']:
        epsilon += pow(2, length-i-1)
    else:
        gamma += pow(2, length-i-1)

print(gamma*epsilon)

file.close()