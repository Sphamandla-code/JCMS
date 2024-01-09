class deer{
    encpyt(str){
        var res = str;
        var chars = {
            'a':'@','A': "q",'b':"3",'B':"Q",'c':"r",'C':"_",'d':"U",'D': "A",'e': 'u','E': "F",
            'f': "E",'F': "x",'G': "W",'g': "w",'H': "Z",'h': "a",'I': "b",'i': "y",'J': "f",
            'j': "I",'L': "X",'l': "z",'M': "i",'m': "Y",'N': "t",'n':'O','o': "0",'O': "R",'P': "c",'p': "o",'Q': "L",
            'q': "p",'R': "9",'r': "P",'s': "d",'S': "j",'T': "~",'t': "J",'u': "s",'U': "4",'V': "S",
            'v': "8",'W': "C",'w': "7",'X': "5",'x': "6",'y': "2",'Y':"1",'Z': "K",'z': "g",'k':"k",'K': "G",
            '@': "e",'0': "M",'1': "N",'2': "m",'9': "l",'3': "n",'8': "D",
            '4': "T",'7': "B",'5': "v",'6': "V",'&': "h",'_': "H",'~': "&"
        }
        res = res.replace(/[aAbBcCdDeEfFGgHhIiJjLlMmNnoOPpQqRrsSTtuUVvWwXxyYZzkK@0129384756&_~]/g,m => chars[m]);
        return res;
    }
    decpyt(str){
        var res = str;
        var chars = {
        '@': "a",'q':"A",'3': "b",'Q':"B",'r':"c",'_':"C",'U': "d",'A':"D",'u': "e",'F':"E",
        'E': "f",'x':"F",
        'W': "G",'w':"g",'Z': "H",'a':"h",'b': "I",'y':"i",'f': "J",'I':"j",'X': "L",'z':"l",
        'i': "M",'Y':"m",'t': "N",'O':"n",'0': "o",'R':"O",'c': "P",'o':"p",'L': "Q",'p':"q",
        '9': "R",'P':"r",'d': "s",'j':"S",'~': "T",'J':"t",'s': "u",'4':"U",'S': "V",'8':"v",
        'C': "W",'7':"w",'5': "X",'6':"x",'2': "y",'1':"Y",'K': "Z",'g':"z",'k': "k",'G':"K",
        'e': "@",'M': "0",'N': "1",'m': "2",'l': "9",'n': "3",'D': "8",'T': "4",'B': "7",
        'v': "5",'V': "6",'h': "&",'H': "_",'&': "~"
        }
        res = res.replace(/[aAbBcCdDeEfFGgHhIiJjLlMmNnoOPpQqRrsSTtuUVvWwXxyYZzkK@0129384756&_~]/g,m => chars[m])
        return res;
    }
    time({format,html,second}){
        let d = new Date();
        let hour = d.getHours();
        let minutes = d.getMinutes();
        let seconds = d.getSeconds();
    
        if(hour < 10){
            hour = 0+""+hour;
        } if(minutes < 10){
            minutes = 0+""+minutes;
        } if(seconds < 10){
            seconds = 0+""+seconds;
        }
        if(format == "12hrs"){
            if(hour > 12){
                hour = hour - 12;
                if(second == true){
                    $(html).html(hour+" : "+minutes+" : "+seconds+" PM");
                }else{
                    $(html).html(hour+" : "+minutes+" PM");
                }
            }
            if(hour < 12){
                if(second == true){
                    $(html).html(hour+" : "+minutes+" : "+seconds+" AM");
                }else{
                    $(html).html(hour+" : "+minutes+" AM");
                }
            }
            if(hour == 12){
                if(second == true){
                    $(html).html(hour+" : "+minutes+" : "+seconds+" PM");
                }else{
                    $(html).html(hour+" : "+minutes+" PM");
                }
            }
            
        }else{
            if(second == true){
                $(html).html(hour+" : "+minutes+" : "+seconds);
            }else{
                $(html).html(hour+" : "+minutes);
            }
        }
    
    }
    date({html,format,days}){
        let d = new Date();
        let date = d.getDate();
        let day = d.getDay();
        let month = d.getMonth();
        let year = d.getFullYear();
    
        var daysInWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var daysInIndex = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var mon= ["January","February","March","April","May","June","July","August","September","October","November","December"];
        var monthIndex = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"];
    
    
    
        if(days == "short"){
            day = daysInIndex[day];
        }if(days == "long"){
            day = daysInWeek[day];
        }
    
        if(format == "long"){
            month = mon[month];
        }if(format == "short"){
            month = monthIndex[month];
        }
    
        if(days == null){
    
            if(format == null){
                month = month+1;
                if(month < 10){
                    month = "0"+month;
                }
                if(date < 10){
                    date = "0"+date;
                }
                $(html).html(date+"/"+month+"/"+year);
            }else{
                $(html).html(date+" "+month+" "+year);
            }
        }else{
            if(format == null){
                month = month+1;
                if(month < 10){
                    month = "0"+month;
                }
                if(date < 10){
                    date = "0"+date;
                }
                $(html).html(day+" "+date+"/"+month+"/"+year);
            }else{
                $(html).html(day+" "+date+" "+month+" "+year);
            }
            
        }
    }
    getdate({format,days}){
        let ans = "";
        let d = new Date();
        let date = d.getDate();
        let day = d.getDay();
        let month = d.getMonth();
        let year = d.getFullYear();
    
        var daysInWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var daysInIndex = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var mon= ["January","February","March","April","May","June","July","August","September","October","November","December"];
        var monthIndex = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"];
    
    
    
        if(days == "short"){
            day = daysInIndex[day];
        }if(days == "long"){
            day = daysInWeek[day];
        }
    
        if(format == "long"){
            month = mon[month];
        }if(format == "short"){
            month = monthIndex[month];
        }
    
        if(days == null){
    
            if(format == null){
                month = month+1;
                if(month < 10){
                    month = "0"+month;
                }
                if(date < 10){
                    date = "0"+date;
                }
               ans = date+"/"+month+"/"+year;
            }else{
                ans = date+" "+month+" "+year;
            }
        }else{
            if(format == null){
                month = month+1;
                if(month < 10){
                    month = "0"+month;
                }
                if(date < 10){
                    date = "0"+date;
                }
                ans = day+" "+date+"/"+month+"/"+year;
            }else{
                ans = day+" "+date+" "+month+" "+year;
            }
            
        }
        return ans;
    }
    getText(str){
        var st = $(str).val();
        return st;
    }
    setText(str,text){
        $(str).val(text);
    }
    setHTML({find,text}){
        $(find).html(text);
    }
    randomString(length) {
        var result           = '';
        var characters       = 'aAbBcCdDeEfFGgHhIiJjLlMmNnoOPpQqRrsSTtuUVvWwXxyYZzkK@0129384756&_~';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
       return result;
    }
}
deer = new deer();
