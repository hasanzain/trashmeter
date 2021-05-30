#include <SPI.h> //penyertaan library header penggunaan interface SPI
#include <nRF24L01.h> //penyertaan library header nRF24L01
#include <RF24.h> //penyertaan library header RF24
 
RF24 radio(9,10); //pin yang dideklarasikan untuk chip enable, chip selector
const uint64_t pipe = 0xE8E8F0F0E1LL;
String terimapesan,id;
int ind1, ind2;
String dataTX2 = "";
String dataTX3 = "";
 
void setup(void){
Serial.begin(9600); //menggunakan serial monitor pada 9600bps
radio.begin(); 
radio.openReadingPipe(1,pipe);
radio.startListening();
}
 
void loop(void){
  terimapesan = "";
  if (radio.available()){ 
    bool selesai = false;
      char pesan[50] = "";
      selesai = radio.read(&pesan, sizeof(pesan));
      Serial.println(pesan);
      delay(900);
  }
  }
