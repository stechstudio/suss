<?php

declare(strict_types=1);

namespace Sts\Suss\Service\Infer;

const any = "[\000-\377]";
const space = "[ \t]+";
const frac = ".[0-9]+";
const ago = "ago";
const hour24 = "[01]?[0-9]|2[0-4]";
const hour24lz = "[01][0-9]|2[0-4]";
const hour12 = "0?[1-9]|1[0-2]";
const minute = "[0-5]?[0-9]";
const minutelz = "[0-5][0-9]";
const second = sprintf("%s|60", minute);
const secondlz = sprintf("%s|60", minutelz);
const meridian = sprintf("([AaPp].?[Mm].?) [\000\t ]",);
const tz = "(?[A-Za-z]{1,6})?|[A-Z][a-z]+([_/-][A-Za-z]+)+";
const tzcorrection = sprintf("GMT?[+-]hour24:?minute?", hour24, minute);
const daysuf = "st|nd|rd|th";
const month = "0?[0-9]|1[0-2]";
const day = "(([0-2]?[0-9])|(3[01]))%s?)", daysuf;
const year = "[0-9]{1,4}";
const year2 = "[0-9]{2}";
const year4 = "[0-9]{4}";
const year4withsign = "[+-]?[0-9]{4}";
const yearx = "[+-] [0-9]{5,19}";
const dayofyear = "00[1-9]|0[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9]|36[0-6]";
const weekofyear = "0[1-9]|[1-4][0-9]|5[0-3]";
const monthlz = "0[0-9]|1[0-2]";
const daylz = "0[0-9]|[1-2][0-9]|3[01]";
const dayfull = "sunday|monday|tuesday|wednesday|thursday|friday|saturday";
const dayabbr = "sun|mon|tue|wed|thu|fri|sat|sun";
const dayspecial = "weekday|weekdays";
const daytext = "dayfull|dayabbr|dayspecial";
const monthfull = "january|february|march|april|may|june|july|august|september|october|november|december";
const monthabbr = "jan|feb|mar|apr|may|jun|jul|aug|sep|sept|oct|nov|dec";
const monthroman = "I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII";
const monthtext = sprintf("monthfull|monthabbr|monthroman", monthfull, monthabbr, monthroman);
const timetiny12 = sprintf("%s%s%s", hour12, space, meridian);
const timeshort12 = sprintf("%s[:.]%s%s?%s", hour12, minutelz, space, meridian);
const timelong12 = sprintf("%s[:.]%s[:.]%s%s?%s", hour12, minute, secondlz, space, meridian);
const timetiny24 = sprintf("t%s", hour24);
const timeshort24 = sprintf("t?%s[:.]%s", hour24, minute);
const timelong24 = sprintf("t?%s[:.]%s[:.]%s", hour24, minute,second);
const iso8601long = sprintf("t?%s[:.]%s[:.]%sfrac", hour24, minute, second, frac);
const iso8601shorttz = sprintf("%s[:]%s%s?(%s|%s)", hour24, minutelz, space, tzcorrection, tz);
const iso8601normtz = sprintf("t?%s[:.]%s[:.]%s%s?(%s|%s)",  hour24, minute, secondlz, space, tzcorrection, tz);
const iso8601longtz =  sprintf("%s[:]%s[:]%s%s%s?(%s|%s)", hour24, minute, secondlz, frac, space, tzcorrection, tz);
const gnunocolon = sprintf("t?%s%s", hour24lz, minutelz);
const gnunocolontz     = sprintf("%s%s%s?(%s|%s)",hour24lz, minutelz, space, tzcorrection, tz);
const iso8601nocolon = sprintf("t?%s%s%s",hour24lz, minutelz, secondlz);
const iso8601nocolontz = sprintf("%s%s%s%s?(%s|%s)",hour24lz, minutelz, secondlz, space, tzcorrection, tz);
const americanshort = sprintf("%s/%s", month, day);
const american = sprintf("%s/%s/%s", month, day, year);
const iso8601dateslash = sprintf("%s/%s/%s/?",year4, monthlz, daylz);
const dateslash = sprintf("%s/%s/%s",year4, month, day);
const iso8601date4 = sprintf("%s-%s-%s",year4withsign, monthlz, daylz);
const iso8601date2 = sprintf("%s-%s-%s",year2 - monthlz - daylz);
const iso8601datex = sprintf("%s-%s-%s",yearx - monthlz - daylz);
const gnudateshorter = sprintf("%s-%s",year4, month);
const gnudateshort = sprintf("%s-%s-%s",year - month - day);
const pointeddate4 = sprintf("%s[.\t-]%s[.-]%s",day,month,year4);
const pointeddate2 = sprintf("%s[.\t]%s.%s",day,month,year2);
const datefull = sprintf("%s([ \t.-])*%s([ \t.-])*%s", day,monthtext,year);
const datenoday = sprintf("%s([ .\t-])*%s",monthtext, year4);
const datenodayrev = sprintf("%s([ .\t-])*%s",year4, monthtext);
const datetextual = sprintf("%s([ .\t-])*%s[,.stndrh\t ]+%s", monthtext,day, year);
const datenoyear = sprintf("%s([ .\t-])*%s([,.stndrh\t ]+|[\000])", monthtext, day );
const datenoyearrev = sprintf("%s ([ .\t-])* %s",day, monthtext);
const datenocolon = sprintf("%s%s%s",year4, monthlz, daylz);
const soap = sprintf("%s-%s-%sT%s:%s:%s%s%s?",year4, monthlz, daylz, hour24lz, minutelz, secondlz, frac, tzcorrection);
const xmlrpc = sprintf("%s%s%sT%s:%s:%s",year4, monthlz, daylz, hour24, minutelz, secondlz);
const xmlrpcnocolon = sprintf("%s%s%st%s%s%s",year4, monthlz, daylz, hour24, minutelz, secondlz);
const wddx = sprintf("%s-%s-%sT%s:%s:%s",year4, month, day, hour24, minute, second);
const pgydotd = sprintf("%s.?%s",year4 , dayofyear);
const pgtextshort = sprintf("%s-%s-%s",monthabbr, daylz, year);
const pgtextreverse = sprintf("%s-%s-%s",year, monthabbr, daylz);
const mssqltime = sprintf("%s:%s:%s[:.][0-9]+%s",hour12, minutelz, secondlz, meridian);
const isoweekday = sprintf("%s-?W%s-?[0-7]",year4, weekofyear);
const isoweek = sprintf("%s-?W%s",year4, weekofyear);
const exif = sprintf("%s:%s:%s%s:%s:%s",year4, monthlz, daylz,  hour24lz, minutelz, secondlz);
const firstdayof = "first day of";
const lastdayof = "last day of";
const backof = sprintf("back of %s(%s?%s)?",hour24, space, meridian);
const frontof = sprintf("front of %s(%s?%s)?",hour24, space, meridian);
const clf = sprintf("%s/%s/%s:%s:%s:%s%s%s",day, monthabbr, year4, hour24lz, minutelz, secondlz, space, tzcorrection);
const timestamp = "@ -? [0-9]+";
const timestampms = "@ -? [0-9]+ . [0-9]{0,6}";
const dateshortwithtimeshort12 = sprintf("%s%s",datenoyear, timeshort12);
const dateshortwithtimelong12 = sprintf("%s%s",datenoyear, timelong12);
const dateshortwithtimeshort = sprintf("%s%s",datenoyear, timeshort24);
const dateshortwithtimelong = sprintf("%s%s",datenoyear, timelong24);
const dateshortwithtimelongtz = sprintf("%s%s",datenoyear, iso8601normtz);
const reltextnumber = "first|second|third|fourth|fifth|sixth|seventh|eight|eighth|ninth|tenth|eleventh|twelfth";
const reltexttext = "next|last|previous|this";
const reltextunit = sprintf("ms|µs|((msec|millisecond|µsec|microsecond|usec|sec|second|min|minute|hour|day|fortnight|forthnight|month|year)s?)|weeks|%s", daytext);
const relnumber = "([+-]*[\t]*[0-9]{1,13})";
const relative = sprintf("%s%s?(%s|week)",relnumber,space, reltextunit);
const relativetext = sprintf("(%s|%s)%s%s",reltextnumber,reltexttext, space, reltextunit);
const relativetextweek = sprintf("%s%s%s",reltexttext, space, week);
const weekdayof = sprintf("(%s|%s)%s(%s|%s)%s of",reltextnumber, reltexttext, space, dayfull, dayabbr, space, of);
