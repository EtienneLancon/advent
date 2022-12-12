def selectCandidate(candidates, criteria):
    i = 0
    j = 0
    while candidates.__len__() > 1:
        bitCount = {'0': 0, '1': 0}
        for candidate in candidates:
            if candidate[i] == '0':
                bitCount['0'] += 1
            else:
                bitCount['1'] += 1

        toRemove = ''
            
        if criteria == 'most':
            if bitCount['1'] >= bitCount['0']:
                toRemove = '0'
            else:
                toRemove = '1'
        else:
            if bitCount['1'] < bitCount['0']:
                toRemove = '0'
            else:
                toRemove = '1'

        j = 0
        while j < candidates.__len__():
            if candidates[j][i] == toRemove:
                candidates.pop(j)
                j -= 1
            j += 1
        
        i += 1

    return candidates[0]

def getDecimal(binarystring):
    decimal = 0
    length = binarystring.__len__()
    for i in range(0, length):
        if(binarystring[i] == '1'):
            decimal += pow(2, length-i-1)

    return decimal


file = open('./data', 'r')

oxygenCandidates = []
carbonCandidates = []

for binary in file:
    oxygenCandidates.append(binary.rstrip())
    carbonCandidates.append(binary.rstrip())



oxygen = selectCandidate(oxygenCandidates, 'most')
carbon = selectCandidate(carbonCandidates, 'least')

print(getDecimal(oxygen)*getDecimal(carbon))

file.close()