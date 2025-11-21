export function timeToMinutes(timeString){
    const digitalTimeParts = timeString.split(':');

    const hours = digitalTimeParts[0];
    const minutes = digitalTimeParts[1];

    const timeInMinutes = (hours * 60) + minutes;
    return Number(timeInMinutes);
}

