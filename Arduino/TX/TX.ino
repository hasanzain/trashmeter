#include <SPI.h> //penyertaan library header penggunaan interface SPI
#include <nRF24L01.h> //penyertaan library header nRF24L01
#include <RF24.h> //penyertaan library header RF24
#include <VL53L0X.h>
#include <Wire.h>


char pesan[50];
RF24 radio(9,10); //instruksi untuk chip enable, dan chip selector
const uint64_t pipe = 0xE8E8F0F0E1LL; 
VL53L0X sensor;
String nilai;


void setup(void){
pinMode(3,INPUT_PULLUP);
digitalWrite(3,HIGH);
Serial.begin(9600);
Wire.begin();
sensor.init();
sensor.setTimeout(500);
sensor.startContinuous(); 
radio.begin(); 
radio.openWritingPipe(pipe);
radio.stopListening();
} //deklarasi pushbutton sebagai input
 
void loop(void){
int dist = sensor.readRangeContinuousMillimeters();
int jarak;
jarak = dist/2;
nilai = "TX1," + String(jarak);
nilai.toCharArray(pesan,50);
radio.write(&pesan, sizeof(pesan));
//Serial.println(nilai);
}
