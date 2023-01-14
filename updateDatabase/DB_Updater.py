#! /usr/bin/python3

import update
import sys



def main(argv):

    if len(argv) == 1:
            Methods = 'nasdaq'

    else:
            Methods = argv[1]           

    Pr = update.Update(Methods)
    Pr.db_update()

if __name__ == '__main__':
    sys.exit(main(sys.argv))

