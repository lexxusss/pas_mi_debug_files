#!/bin/bash

# zalando
#wget -O /home/lrzepecki/php/csv/import-zalando.csv "http://productdata.zanox.com/exportservice/v1/rest/27899028C75167572.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&cm=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&df=&dt=&ds=&dl=&ia=&im=&il=&mn=&lk=&td=&tm=&ea=&is=&sh=&sn=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&bp=&bt=&gZipCompress=null"

wget -O /home/lrzepecki/php/csv/import-zalando.csv "http://productdata.zanox.com/exportservice/v1/rest/27899028C75167572.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

# asos
wget -O /home/lrzepecki/php/csv/import-asos.csv "http://productdata.zanox.com/exportservice/v1/rest/27623526C58613890.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"
#http://productdata.zanox.com/exportservice/v1/rest/27623526C58613890.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&cm=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&df=&dt=&ds=&dl=&ia=&im=&il=&mn=&lk=&td=&tm=&ea=&is=&sh=&sn=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&bp=&bt=&gZipCompress=null"

# answear
wget -O /home/lrzepecki/php/csv/import-answear.csv "http://productdata.zanox.com/exportservice/v1/rest/27612142C97199361.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x6=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#http://productdata.zanox.com/exportservice/v1/rest/27612142C97199361.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"
#http://productdata.zanox.com/exportservice/v1/rest/27612142C97199361.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&cm=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&df=&dt=&ds=&dl=&ia=&im=&il=&mn=&lk=&td=&tm=&ea=&is=&sh=&sn=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&bp=&bt=&gZipCompress=null"

#stradivarius
wget -O /home/lrzepecki/php/csv/import-stradiv.csv "http://productdata.zanox.com/exportservice/v1/rest/31083138C509989910.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"


