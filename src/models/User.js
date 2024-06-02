// Define the User class
class User {
    constructor(firstName, lastName, matricNo, yearCourse, phoneNumber, address, email, password) {
      this.firstName = firstName;
      this.lastName = lastName;
      this.matricNo = matricNo;
      this.yearCourse = yearCourse;
      this.phoneNumber = phoneNumber;
      this.address = address;
      this.email = email;
      this.password = password;
    }
  
    logDetails() {
      console.log(`First Name: ${this.firstName}, Last Name: ${this.lastName}, Matric No: ${this.matricNo}, Year/Course: ${this.yearCourse}, Phone Number: ${this.phoneNumber}, Address: ${this.address}, Email: ${this.email}, Password: ${this.password}`);
    }
  }
  
  export default User;
  