import json, sys, requests
# import http.client, urllib


def clasificador_violencia(num_preg,ocurrio):
    Vf=0
    Vs=0
    Vp=0
    
    if(num_preg<=3 and ocurrio==1):
        Vf=1
        
    elif(num_preg>3 and num_preg<=13 and ocurrio==1):
        Vs=1
        
    elif(num_preg>13 and ocurrio==1):
        Vp=1
        
    return(Vf,Vs,Vp)

def nivel_riesgo(pond_r_vf,pond_r_vs,pond_r_vp,pond_e_vf,pond_e_vs,pond_e_vp):
    sum_rvf=sum(pond_r_vf)
    sum_rvs=sum(pond_r_vs)
    sum_rvp=sum(pond_r_vp)
    sum_evf=sum(pond_e_vf)
    sum_evs=sum(pond_e_vs)
    sum_evp=sum(pond_e_vp)
    
    if(sum_rvf==0):
        r_vf=0
    elif(sum_rvf>0 and sum_rvf<=3.800975):
        r_vf=1
    elif(sum_rvf>3.800975 and sum_rvf<=7.60195):
        r_vf=2
    elif(sum_rvf>7.60195 and sum_rvf<=11.402925):
        r_vf=3
    elif(sum_rvf>11.402925):
        r_vf=4
    
    if(sum_rvs==0):
        r_vs=0
    elif(sum_rvs>0 and sum_rvs<=11.58525):
        r_vs=1
    elif(sum_rvs>11.58525 and sum_rvs<=23.1705):
        r_vs=2
    elif(sum_rvs>23.1705 and sum_rvs<=34.75575):
        r_vs=3
    elif(sum_rvs>34.75575):
        r_vs=4
        
    if(sum_rvp==0):
        r_vp=0
    elif(sum_rvp>0 and sum_rvp<=4.30275):
        r_vp=1
    elif(sum_rvp>4.30275 and sum_rvp<=8.6055):
        r_vp=2
    elif(sum_rvp>8.6055 and sum_rvp<=12.90825):
        r_vp=3
    elif(sum_rvp>12.90825):
        r_vp=4
        
    if(sum_evf==0):
        e_vf=0
    elif(sum_evf>0 and sum_evf<=2.04925):
        e_vf=1
    elif(sum_evf>2.04925 and sum_evf<=4.0985):
        e_vf=2
    elif(sum_evf>4.0985 and sum_evf<=6.14775):
        e_vf=3
    elif(sum_evf>6.14775):
        e_vf=4
    
    if(sum_evs==0):
        e_vs=0
    elif(sum_evs>0 and sum_evs<=0.99125):
        e_vs=1
    elif(sum_evs>0.99125 and sum_evs<=1.9825):
        e_vs=2
    elif(sum_evs>1.9825 and sum_evs<=2.97375):
        e_vs=3
    elif(sum_evs>2.97375):
        e_vs=4
        
    if(sum_evp==0):
        e_vp=0
    elif(sum_evp>0 and sum_evp<=1.792):
        e_vp=1
    elif(sum_evp>1.792 and sum_evp<=3.584):
        e_vp=2
    elif(sum_evp>3.584 and sum_evp<=5.376):
        e_vp=3
    elif(sum_evp>5.376):
        e_vp=4
    
    return(r_vf,r_vs,r_vp,e_vf,e_vs,e_vp)

#Definir lista de agresores asociada a cada pregunta
def agresor(agr):
    lista_agresor=['maestro','maestra','compañero','compañera','director(a)','trabajador','trabajadora','desconocido','otro']
    agr_x=[]
    agr=''.join(reversed(agr))
    for i in range(0,len(agr)):
        if (agr[i]=='1'):
            agr_x.append(lista_agresor[i])
        i+=1
    return (agr_x)

#Definir lista de lugares asociados a cada pregunta
def lugar(lug):
    lista_lugar=['escuela','lugar_cerca','lugar_lejos','transporte','casa','otro','no_especificado']
    lug_x=[]
    lug=''.join(reversed(lug))
    for i in range(0,len(lug)):
        if (lug[i]=='1'):
            lug_x.append(lista_lugar[i])
        i+=1
    return (lug_x)
    
#Definir lista de frecuencias asociadas a cada pregunta
def frecuencia(frec):
    lista_frecuencia=['muchas_veces','pocas_veces','una_vez']
    frec_x=[]
    frec=''.join(reversed(frec))
    for i in range(0,len(frec)):
        if (frec[i]=='1'):
            frec_x.append(lista_frecuencia[i])
        i+=1
    return (frec_x)

#Definir ponderación asociada a Vf, Vs o Vp asociada a probabilidad de reincidencia de cada pregunta
def ponderacion_reincidencia(num_preg,ocurrio,agresor_x,lugar_x,frecuencia_x):
    pond_agr_r=[{'maestro':0.329,'maestra':0.2429,'compañero':1,'compañera':0.733,'director(a)':0.008,'trabajador':0.004,'trabajadora':0.000,'desconocido':0.026,'otro':0.035},{'maestro':0.120,'maestra':0.087,'compañero':1,'compañera':0.919,'director(a)':0.000,'trabajador':0.053,'trabajadora':0.006,'desconocido':0.711,'otro':0.335},{'maestro':.0244,'maestra':0.233,'compañero':0.955,'compañera':1,'director(a)':0.007,'trabajador':0.002,'trabajadora':0.001,'desconocido':0.034,'otro':0.033},{'maestro':0.147,'maestra':0.006,'compañero':1,'compañera':0.047,'director(a)':0.010,'trabajador':0.063,'trabajadora':0.007,'desconocido':0.742,'otro':0.190},{'maestro':0.532,'maestra':0.040,'compañero':1,'compañera':0.115,'director(a)':0.032,'trabajador':0.108,'trabajadora':0.012,'desconocido':0.667,'otro':0.283},{'maestro':0.472,'maestra':0.074,'compañero':1,'compañera':0.277,'director(a)':0.037,'trabajador':0.074,'trabajadora':0.009,'desconocido':0.324,'otro':0.287},{'maestro':0.563,'maestra':0.004,'compañero':1,'compañera':0.056,'director(a)':0.043,'trabajador':0.109,'trabajadora':0.017,'desconocido':0.698,'otro':0.441},{'maestro':1,'maestra':0.013,'compañero':0.103,'compañera':0.002,'director(a)':0.032,'trabajador':0.018,'trabajadora':0.003,'desconocido':0.025,'otro':0.030},{'maestro':0.157,'maestra':0.005,'compañero':1,'compañera':0.044,'director(a)':0.004,'trabajador':0.025,'trabajadora':0.002,'desconocido':0.249,'otro':0.084},{'maestro':0.225,'maestra':0.004,'compañero':1,'compañera':0.025,'director(a)':0.005,'trabajador':0.021,'trabajadora':0.002,'desconocido':0.299,'otro':0.113},{'maestro':0.616,'maestra':0.023,'compañero':1,'compañera':0.069,'director(a)':0.023,'trabajador':0.116,'trabajadora':0.023,'desconocido':0.883,'otro':0.604},{'maestro':1,'maestra':0.193,'compañero':0.869,'compañera':0.107,'director(a)':0.081,'trabajador':0.047,'trabajadora':0.021,'desconocido':0.156,'otro':0.127},{'maestro':0.129,'maestra':0.004,'compañero':1,'compañera':0.210,'director(a)':0.006,'trabajador':0.006,'trabajadora':0.000,'desconocido':0.507,'otro':0.230},{'maestro':0.429,'maestra':0.055,'compañero':1,'compañera':0.116,'director(a)':0.020,'trabajador':0.037,'trabajadora':0.012,'desconocido':0.350,'otro':0.231},{'maestro':0.105,'maestra':0.011,'compañero':0.545,'compañera':0.160,'director(a)':0.009,'trabajador':0.030,'trabajadora':0.007,'desconocido':1,'otro':0.265},{'maestro':1,'maestra':0.065,'compañero':0.140,'compañera':0.031,'director(a)':0.045,'trabajador':0.026,'trabajadora':0.004,'desconocido':0.041,'otro':0.033},{'maestro':0.484,'maestra':0.105,'compañero':1,'compañera':0.142,'director(a)':0.022,'trabajador':0.034,'trabajadora':0.013,'desconocido':0.169,'otro':0.108}]
    
    pond_lug_r=[{'escuela':1,'lugar_cerca':0.113,'lugar_lejos':0.022,'transporte':0.005,'casa':0.017,'otro':0,'no_especificado':0},{'escuela':1,'lugar_cerca':0.615,'lugar_lejos':0.153,'transporte':0,'casa':0.076,'otro':0,'no_especificado':0},{'escuela':1,'lugar_cerca':0.057,'lugar_lejos':0.021,'transporte':0.003,'casa':0.004,'otro':0,'no_especificado':0},{'escuela':1,'lugar_cerca':0.185,'lugar_lejos':0.055,'transporte':0.018,'casa':0.037,'otro':0.018,'no_especificado':0},{'escuela':1,'lugar_cerca':0.281,'lugar_lejos':0.148,'transporte':0.007,'casa':0.039,'otro':0.015,'no_especificado':0},{'escuela':1,'lugar_cerca':0.250,'lugar_lejos':0,'transporte':0,'casa':0.250,'otro':0,'no_especificado':0},{'escuela':1,'lugar_cerca':0.173,'lugar_lejos':0.086,'transporte':0,'casa':0.347,'otro':0,'no_especificado':0},{'escuela':1,'lugar_cerca':0.042,'lugar_lejos':0.053,'transporte':0,'casa':0,'otro':0.010,'no_especificado':0},{'escuela':1,'lugar_cerca':0.213,'lugar_lejos':0.053,'transporte':0.022,'casa':0.001,'otro':0.012,'no_especificado':0},{'escuela':1,'lugar_cerca':0.091,'lugar_lejos':0.061,'transporte':0.048,'casa':0.026,'otro':0.026,'no_especificado':0},{'escuela':0.833,'lugar_cerca':0,'lugar_lejos':1,'transporte':0,'casa':0.666,'otro':0.166,'no_especificado':0},{'escuela':1,'lugar_cerca':0.039,'lugar_lejos':0.028,'transporte':0.007,'casa':0.003,'otro':0.003,'no_especificado':0.003},{'escuela':0,'lugar_cerca':0,'lugar_lejos':0,'transporte':0,'casa':0.,'otro':0,'no_especificado':0},{'escuela':1,'lugar_cerca':0.085,'lugar_lejos':0.051,'transporte':0.012,'casa':0.043,'otro':0.012,'no_especificado':0},{'escuela':0.717,'lugar_cerca':1,'lugar_lejos':0.166,'transporte':0.014,'casa':0.014,'otro':0,'no_especificado':0},{'escuela':1,'lugar_cerca':0.076,'lugar_lejos':0.051,'transporte':0,'casa':0,'otro':0.025,'no_especificado':0},{'escuela':1,'lugar_cerca':0.055,'lugar_lejos':0.020,'transporte':0.003,'casa':0.017,'otro':0.006,'no_especificado':0}]
    
    pond_frec_r=[{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333},{'muchas_veces':1,'pocas_veces':0.666,'una_vez':0.333}]
                 
    pond_r=[]
    n=num_preg-1
    agresor_r=pond_agr_r[n]
    lugar_r=pond_lug_r[n]
    frec_r=pond_frec_r[n]
    if(ocurrio==1):
        for i in agresor_x:
            pond_r.append(agresor_r[i])
        for i in lugar_x:
            pond_r.append(lugar_r[i])
        for i in frecuencia_x:
            pond_r.append(frec_r[i])
    sum_pond_r=sum(pond_r)
    return(sum_pond_r)
    
def ponderacion_escalabilidad(num_preg, ocurrio, agresor_x,lugar_x,frecuencia_x):
    #pond_agr_e=[{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':1},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':1,'otro':1},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':1},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]},{'maestro':[1,1],'maestra':[1,1],'compañero':[1,1],'compañera':[1,1],'director(a)':[1,1],'trabajador':[1,1],'trabajadora':[1,1],'desconocido':[1,1],'otro':[1,1]}]
    #pond_lug_e=[{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]},{'escuela':[1,1],'lugar_cerca':[1,1],'lugar_lejos':[1,1],'transporte':[1,1],'casa':[1,1],'otro':[1,1],'no_especificado':[1,1]}]
    #pond_frec_e=[{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]},{'muchas_veces':[1,1],'pocas_veces':[1,1],'una_vez':[1,1]}]
    
    pond_preg=[{'vp':0.365,'vs':0.414},{'vp':0.537,'vs':0.657},{'vp':0.022,'vs':0.018},{'vp':0.524,'vf':0.272},{'vp':0.627,'vf':0.614},{'vp':0.652,'vf':0.771},{'vp':0.669,'vf':0.6919},{'vp':0.668,'vf':0.476},{'vp':0.527,'vf':0.547},{'vp':0.545,'vf':0.635},{'vp':0.782,'vf':0.712},{'vp':0.717,'vf':0.629},{'vp':0.533,'vf':0.560},{'vf':0.509,'vs':0.566},{'vf':0.561,'vs':0.671},{'vf':0.587,'vs':0.902},{'vf':0.633,'vs':0.737}]
    
    pond_e_vf=[]
    pond_e_vs=[]
    pond_e_vp=[]
    
    n=num_preg-1
    
    pond=pond_preg[n]
    if (ocurrio==1):
        if(n<=2):
            pond_e_vp.append(pond['vp'])
            pond_e_vs.append(pond['vs'])
        elif(n>2 and n<=12):
            pond_e_vp.append(pond['vp'])
            pond_e_vf.append(pond['vf'])
        elif(n>12):
            pond_e_vf.append(pond['vf'])
            pond_e_vs.append(pond['vs'])
    sum_pond_e_vf=sum(pond_e_vf)
    sum_pond_e_vs=sum(pond_e_vs)
    sum_pond_e_vp=sum(pond_e_vp)
    return(sum_pond_e_vf,sum_pond_e_vs,sum_pond_e_vp)

lst =  json.loads(sys.argv[1])
# [{"id_pregunta_respondida":"60","numero_control":"14330618","id_pregunta":"1","_0":"1","_1":"1","_2":"1","_3":"1"},{"id_pregunta_respondida":"61","numero_control":"14330618","id_pregunta":"2","_0":"1","_1":"2","_2":"2","_3":"2"},{"id_pregunta_respondida":"62","numero_control":"14330618","id_pregunta":"3","_0":"1","_1":"3","_2":"3","_3":"3"},{"id_pregunta_respondida":"63","numero_control":"14330618","id_pregunta":"4","_0":"1","_1":"4","_2":"4","_3":"4"},{"id_pregunta_respondida":"64","numero_control":"14330618","id_pregunta":"5","_0":"1","_1":"5","_2":"5","_3":"5"},{"id_pregunta_respondida":"65","numero_control":"14330618","id_pregunta":"6","_0":"1","_1":"6","_2":"6","_3":"6"},{"id_pregunta_respondida":"66","numero_control":"14330618","id_pregunta":"7","_0":"1","_1":"7","_2":"7","_3":"7"},{"id_pregunta_respondida":"67","numero_control":"14330618","id_pregunta":"8","_0":"1","_1":"8","_2":"8","_3":"1"},{"id_pregunta_respondida":"68","numero_control":"14330618","id_pregunta":"9","_0":"1","_1":"9","_2":"9","_3":"1"},{"id_pregunta_respondida":"69","numero_control":"14330618","id_pregunta":"10","_0":"1","_1":"10","_2":"10","_3":"1"},{"id_pregunta_respondida":"70","numero_control":"14330618","id_pregunta":"11","_0":"1","_1":"11","_2":"11","_3":"1"},{"id_pregunta_respondida":"71","numero_control":"14330618","id_pregunta":"12","_0":"1","_1":"12","_2":"12","_3":"1"},{"id_pregunta_respondida":"72","numero_control":"14330618","id_pregunta":"13","_0":"1","_1":"13","_2":"11","_3":"1"},{"id_pregunta_respondida":"73","numero_control":"14330618","id_pregunta":"14","_0":"1","_1":"14","_2":"14","_3":"1"},{"id_pregunta_respondida":"74","numero_control":"14330618","id_pregunta":"15","_0":"1","_1":"15","_2":"15","_3":"4"},{"id_pregunta_respondida":"75","numero_control":"14330618","id_pregunta":"16","_0":"1","_1":"16","_2":"16","_3":"2"},{"id_pregunta_respondida":"76","numero_control":"14330618","id_pregunta":"17","_0":"0","_1":"0","_2":"0","_3":"0"}]
#lst=[{"id_pregunta_respondida":"60","numero_control":"14330618","id_pregunta":"1","_0":"0","_1":"4","_2":"1","_3":"1"}]
pond_r_vf=[]
pond_r_vs=[]
pond_r_vp=[]
pond_e_vf=[]
pond_e_vs=[]
pond_e_vp=[]

clasif_Vf=[]
clasif_Vs=[]
clasif_Vp=[]

Vf=0
Vp=0
Vs=0
n_control=lst[1]['numero_control']

for i in range(0,len(lst)):
    dict=(lst[i])
    num_preg=int(dict['id_pregunta'])
    ocurrio=int(dict['_0'])
    agres=int(dict['_1'])
    luga=int(dict['_2'])
    frecuen=int(dict['_3'])
    agr=str(bin(agres)).lstrip("0b").zfill(9)
    lug=str(bin(luga)).lstrip("0b").zfill(7)
    frec=str(bin(frecuen)).lstrip("0b").zfill(3)
    
    agresor_x=agresor(agr)
    lugar_x=lugar(lug)
    frecuencia_x=frecuencia(frec)
    
    ponderacion_r=ponderacion_reincidencia(num_preg,ocurrio,agresor_x,lugar_x,frecuencia_x)
    ponderacion_e=ponderacion_escalabilidad(num_preg,ocurrio,agresor_x,lugar_x,frecuencia_x)
    clasif=clasificador_violencia(num_preg,ocurrio)
    
    if(num_preg<=3):
        pond_r_vf.append(ponderacion_r)
        pond_e_vp.append(ponderacion_e[2])
        pond_e_vs.append(ponderacion_e[1])
        clasif_Vf.append(clasif[0])
        
    elif(num_preg>=4 and num_preg<=13):
        pond_r_vs.append(ponderacion_r)
        pond_e_vf.append(ponderacion_e[0])
        pond_e_vp.append(ponderacion_e[2])
        clasif_Vs.append(clasif[1])
        
    elif(num_preg>13):
        pond_r_vp.append(ponderacion_r)
        pond_e_vf.append(ponderacion_e[0]) 
        pond_e_vs.append(ponderacion_e[1])
        clasif_Vp.append(clasif[2])
    
    i+=1

nivel=nivel_riesgo(pond_r_vf,pond_r_vs,pond_r_vp,pond_e_vf,pond_e_vs,pond_e_vp)
if(sum(clasif_Vf)>0):
    Vf=1
else:
    Vf=0
if(sum(clasif_Vs)>0):
    Vs=1
else:
    Vs=0
if(sum(clasif_Vp)>0):
    Vp=1
else:
    Vp=0
result={'numero_control':n_control,'Vf':Vf,'Vs':Vs,'Vp':Vp,'RVf':nivel[0],'RVs':nivel[1],'RVp':nivel[2],'EVf':nivel[3],'EVs':nivel[4],'EVp':nivel[5]}  

json_string=json.dumps(result)
print(json_string)
# print (result)



# url = "/Applications/MAMP/htdocs/riesgoinstitucional/application/respuestas.php"
# headers = {'Content-type': 'application/json', 'Accept': 'text/plain'}

# r = requests.post(url, json=result)
# print(r.text)

# print(sum(pond_r_vf))
# print(sum(pond_r_vs))
# print(sum(pond_r_vp))
# print(sum(pond_e_vf))
# print(sum(pond_e_vs))
# print(sum(pond_e_vp))