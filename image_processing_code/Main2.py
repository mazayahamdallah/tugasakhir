# python Main2.py @ untuk running pintu keluar

import csv
import sklearn
import imutils
import argparse
import cv2
import numpy as np
import Preprocess as pp
import os
import time
import datetime
import math
import Calibration as cal
import collections
import DetectChars
import DetectPlates
import PossiblePlate
import time

from imutils.video import WebcamVideoStream
from database import data,check,updatetime

# Module level variables for image ##########################################################################

SCALAR_BLACK = (0.0, 0.0, 0.0)
SCALAR_WHITE = (255.0, 255.0, 255.0)
SCALAR_YELLOW = (0.0, 255.0, 255.0)
SCALAR_GREEN = (0.0, 255.0, 0.0)
SCALAR_RED = (0.0, 0.0, 255.0)
VERIF = 2

# Main ##################################################################################################

def main():

    ap = argparse.ArgumentParser()
    ap.add_argument("-v", "--video",
        help = "path to video file")

    ap.add_argument("-i", "--image",
        help = "Path to the image")

    ap.add_argument("-c", "--calibration",
        help = "image or video or camera")
    args = vars(ap.parse_args())

    if args.get("calibration", True):
        imgOriginalScene = cv2.imread(args["calibration"])
        if imgOriginalScene is None:
    	    print("Please check again the path of image or argument !")

        imgOriginalScene  = imutils.resize(imgOriginalScene, width = 640)
        cal.calibration(imgOriginalScene)
        return

    if args.get("video", True):
        camera = cv2.VideoCapture(args["video"])
        if camera is None:
            print("   Please check again the path of video or argument !")
        loop = True

    elif args.get("image", True):
        #imgOriginalScene = cv2.imread(args["image"])
        imgOriginalScene = cv2.imread("media/gspeintercon/GSPE1/GSPE/OCR/plat4.JPG")
        if imgOriginalScene is None:
            print("   Please check again the path of image or argument !")
        loop = False
    else:
        camera = cv2.VideoCapture(0)
        loop = True

    # add knn library for detect chars
    blnKNNTrainingSuccessful = DetectChars.loadKNNDataAndTrainKNN()             # attempt KNN training

    if blnKNNTrainingSuccessful == False:                                       # if KNN training was not successful
        print("\nerror: KNN traning was not successful\n")                      # show error message
        return
    count = 0
    # not very important, just iterating for license array haha
    license = []
    VER = np.zeros(VERIF)
    for x in VER:
        license.append("")
    numlicense = ""
    knn = 0

    # Looping for Video
    while (loop):
        # grab the current frame
        (grabbed, frame) = camera.read()
        #frame = camera.read()
        if args.get("video") and not grabbed:
            break
        # resize the frame and convert it to grayscale
        imgOriginalScene  = imutils.resize(frame, width = 640)
        imgGrayscale, imgThresh = pp.preprocess(imgOriginalScene)
        cv2.imshow("threshold", imgThresh)
        #imgOriginalScene = imutils.transform (imgOriginalScene)
        imgOriginalScene, licenses = searching(imgOriginalScene,loop)

        # only save 5 same license each time
        license[count+1] = licenses
        nums = license[VERIF-1]
        if (license[count] == license[count+1]):
            license[count]=license[count+1]
            count = count + 1
        elif (license[count] != license[count+1]):
            coba = license[count+1]
            count = 0
            license[count] = coba
        if count == (VERIF-1):

            global plat
            plat = "         "
            plat = list(plat)
            numstring = ""
            numstring = list(numstring)
            alphastring = ""
            alphastring = list(alphastring)
            numbers = sum(c.isdigit() for c in nums)
            words   = sum(c.isalpha() for c in nums)

            for i in nums:
                if i.isalpha():
                    alphastring.append(i)
                elif i.isdigit():
                    numstring.append(i)

            print(nums)
            print(numstring)
            print(alphastring)

            #add numbers

            a = 2
            for b in numstring:
                plat[a] = b
                a+=1

            #add front letter(s)

            c = 0
            sumfront = sum(c.isalpha() for c in nums[0:2])
            if (sumfront == 1):
                for d in nums[0:1]:
                    plat[c] = d
                    c+=1
            elif (sumfront == 2):
                for d in nums[0:2]:
                    plat[c] = d
                    c+=1

            #add back letter(s)

            e = -3
            sumback = sum(e.isalpha() for e in nums[-3:])
            if (sumback == 1):
                for f in nums[-1:]:
                    plat[e] = f
                    e+=1
            elif (sumback == 2):
                for f in nums[-2:]:
                    plat[e] = f
                    e+=1
            elif (sumback == 3):
                for f in nums[-3:]:
                    plat[e] = f
                    e+=1

            plat = ''.join(plat)

            if (license[VERIF-1] == ""):
                print("no characters were detected\n")
            else:
                #if number license same, not be saved

                if (numlicense == license[VERIF-1]):
                    print("still = " + numlicense + "\n")
                elif (len(nums) <= 9 and nums[0] >= 'A' and nums[0] <= 'Z' and numbers <= 4 and words <= 5):

                    numlicense = license[VERIF-1]
                    print("A new license plate read from image = " + plat + "\n")
                    cv2.imshow(plat, imgOriginalScene)
                    insertdata= updatetime(numlicense)
                    if check(numlicense):
                        ts = time.time()
                        timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d')
                        timestamp2 = datetime.datetime.fromtimestamp(ts).strftime('%H:%M:%S')

                        #Ganti Path sesuai dengan laptop masing2
                        namefile = "/Documents/"+ license[VERIF-1] + timestamp + timestamp2 + ".png"
                        cv2.imwrite(namefile, imgOriginalScene)

            count = 0

        cv2.putText(imgOriginalScene,"Press 's' to save frame to be 'save.png', for calibrating",(10,30),cv2.FONT_HERSHEY_SIMPLEX, 0.5,(255,255,255),1,bottomLeftOrigin = False)
        cv2.rectangle(imgOriginalScene,((int(imgOriginalScene.shape[1]/2-230)),(int(imgOriginalScene.shape[0]/2-80))),((int(imgOriginalScene.shape[1]/2+230)),(int(imgOriginalScene.shape[0]/2+80))),SCALAR_GREEN,3)
        cv2.imshow("imgOriginalScene", imgOriginalScene)

        key = cv2.waitKey(5) & 0xFF
        if key == ord('s'):
            knn = str(knn)
            savefileimg = "calib_knn/img_"+ knn +".png"
            savefileThr = "calib_knn/Thr_"+ knn +".png"
            #cv2.saveimage("save.png", imgOriginalScene)
            cv2.imwrite(savefileimg, frame)
            cv2.imwrite(savefileThr, imgThresh)
            print("image save !")
            knn = int(knn)
            knn = knn + 1
        if key == 27: # if the 'q' key is pressed, stop the loop
            break
            camera.release() # cleanup the camera and close any open windows

    # For image only
    if (loop == False):
        imgOriginalScene  = imutils.resize(imgOriginalScene, width = 850)
        cv2.imshow("original",imgOriginalScene)
        imgGrayscale, imgThresh = pp.preprocess(imgOriginalScene)
        cv2.imshow("threshold",imgThresh)
        #imgOriginalScene = imutils.transform (imgOriginalScene)
        imgOriginalScene,license = searching(imgOriginalScene,loop)
        #imgOriginalScene = imutils.detransform(imgOriginalScene)

        cv2.waitKey(0)
    cv2.waitKey(0)
    cv2.destroyAllWindows()
    return

# end main

###################################################################################################
def drawRedRectangleAroundPlate(imgOriginalScene, licPlate):

    p2fRectPoints = cv2.boxPoints(licPlate.rrLocationOfPlateInScene)            # get 4 vertices of rotated rect
    cv2.line(imgOriginalScene, tuple(p2fRectPoints[0]), tuple(p2fRectPoints[1]), SCALAR_RED, 2)         # draw 4 red lines
    cv2.line(imgOriginalScene, tuple(p2fRectPoints[1]), tuple(p2fRectPoints[2]), SCALAR_RED, 2)
    cv2.line(imgOriginalScene, tuple(p2fRectPoints[2]), tuple(p2fRectPoints[3]), SCALAR_RED, 2)
    cv2.line(imgOriginalScene, tuple(p2fRectPoints[3]), tuple(p2fRectPoints[0]), SCALAR_RED, 2)
# end function

###################################################################################################
def writeLicensePlateCharsOnImage(imgOriginalScene, licPlate):
    ptCenterOfTextAreaX = 0                             # this will be the center of the area the text will be written to
    ptCenterOfTextAreaY = 0

    ptLowerLeftTextOriginX = 0                          # this will be the bottom left of the area that the text will be written to
    ptLowerLeftTextOriginY = 0

    sceneHeight, sceneWidth, sceneNumChannels = imgOriginalScene.shape
    plateHeight, plateWidth, plateNumChannels = licPlate.imgPlate.shape

    intFontFace = cv2.FONT_HERSHEY_SIMPLEX                      # choose a plain jane font
    fltFontScale = float(plateHeight) / 30.0                    # base font scale on height of plate area
    intFontThickness = int(round(fltFontScale * 1.5))           # base font thickness on font scale

    textSize, baseline = cv2.getTextSize(licPlate.strChars, intFontFace, fltFontScale, intFontThickness)        # call getTextSize

            # unpack roatated rect into center point, width and height, and angle
    ( (intPlateCenterX, intPlateCenterY), (intPlateWidth, intPlateHeight), fltCorrectionAngleInDeg ) = licPlate.rrLocationOfPlateInScene

    intPlateCenterX = int(intPlateCenterX)              # make sure center is an integer
    intPlateCenterY = int(intPlateCenterY)

    ptCenterOfTextAreaX = int(intPlateCenterX)         # the horizontal location of the text area is the same as the plate
    ptRegionX = int(intPlateCenterX)

    if intPlateCenterY < (sceneHeight * 0.75):                                                  # if the license plate is in the upper 3/4 of the image
        ptCenterOfTextAreaY = int(round(intPlateCenterY)) + int(round(plateHeight * 1.6))      # write the chars in below the plate
        ptRegionY = ptCenterOfTextAreaY + int(round(plateHeight * 1.6))
    else:                                                                                       # else if the license plate is in the lower 1/4 of the image
        ptCenterOfTextAreaY = int(round(intPlateCenterY)) - int(round(plateHeight * 1.6))      # write the chars in above the plate
        ptRegionY = ptCenterOfTextAreaY - int(round(plateHeight * 1.6))
    # end if

    textSizeWidth, textSizeHeight = textSize                # unpack text size width and height

    ptLowerLeftTextOriginX = int(ptCenterOfTextAreaX - (textSizeWidth / 2))           # calculate the lower left origin of the text area
    ptLowerLeftTextOriginY = int(ptCenterOfTextAreaY + (textSizeHeight / 2))          # based on the text area center, width, and height

    ptLowerLeftRegionX = int(ptRegionX - (textSizeWidth / 2))           # calculate the lower left origin of the text area
    ptLowerLeftRegionY = int(ptRegionY + (textSizeHeight / 2))
            # write the text on the image
    cv2.putText(imgOriginalScene, licPlate.strChars, (ptLowerLeftTextOriginX, ptLowerLeftTextOriginY), intFontFace, fltFontScale, SCALAR_YELLOW, intFontThickness)
# end function

# searching the plate license ##################################################################################################
def searching(imgOriginalScene,loop):
    licenses = ""
    if imgOriginalScene is None:                            # if image was not read successfully
        print("error: image not read from file \n")      # print error message to std out
        os.system("pause")                                  # pause so user can see error message
        return
        # end if
    listOfPossiblePlates = DetectPlates.detectPlatesInScene(imgOriginalScene)           # detect plates
    #time.sleep(0.02)
    listOfPossiblePlates = DetectChars.detectCharsInPlates(listOfPossiblePlates)        # detect chars in plates
    #time.sleep(0.05)

    if (loop == False):
        cv2.imshow("imgOriginalScene", imgOriginalScene)

    if len(listOfPossiblePlates) == 0:
        if (loop == False):                          # if no plates were found
            print("no license plates were detected\n")             # inform user no plates were found
    else:                                                       # else
                    # if we get in here list of possible plates has at leat one plate

                    # sort the list of possible plates in DESCENDING order (most number of chars to least number of chars)
        listOfPossiblePlates.sort(key = lambda possiblePlate: len(possiblePlate.strChars), reverse = True)
                    # suppose the plate with the most recognized chars (the first plate in sorted by string length descending order) is the actual plate
        licPlate = listOfPossiblePlates[0]

        if (loop == False):
            cv2.imshow("imgPlate", licPlate.imgPlate)           # show crop of plate and threshold of plate
            cv2.imshow("imgThresh", licPlate.imgThresh)

        if (len(licPlate.strChars) == 0):                     # if no chars were found in the plate
            if (loop == False):
                print("no characters were detected\n")
                return       # show message
            # end if
        drawRedRectangleAroundPlate(imgOriginalScene, licPlate)
        writeLicensePlateCharsOnImage(imgOriginalScene, licPlate)
        licenses = licPlate.strChars

        if (loop == False):

            print("license plate read from image = " + licenses + "\n")       # write license plate text to std out
                  # write license plate text on the image

        if (loop == False):
            cv2.imshow("imgOriginalScene", imgOriginalScene)                # re-show scene image
            cv2.imwrite("imgOriginalScene.png", imgOriginalScene)

    return imgOriginalScene, licenses

###################################################################################################
if __name__ == "__main__":
    main()
