import mysql.connector
from mysql.connector import (connection)
from mysql.connector import errorcode

result = {'numero_control': '14330611', 'Vf': 1, 'Vs': 1, 'Vp': 0, 'RVf': 1, 'RVs': 1, 'RVp': 0, 'EVf': 1, 'EVs': 1, 'EVp': 1}

cnx = connection.MySQLConnection(user='admin', password='admin',
                              host='localhost',
                              database='riesgoinstitucional')
try:
  cnx 
except mysql.connector.Error as err:
  if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
    print("Something is wrong with your user name or password")
  elif err.errno == errorcode.ER_BAD_DB_ERROR:
    print("Database does not exist")
  else:
    print(err)

print(result.keys())
print(result.values())

mycursor = cnx.cursor()

qmarks =', '.join([ '%s']* len(result))
columns=', '.join(result.keys())
qry = "Insert Into RESPUESTAS (%s) Values (%s)" % (columns, qmarks)
mycursor.execute(qry, list(result.values()))
cnx.commit()

mycursor.close()
cnx.close()
